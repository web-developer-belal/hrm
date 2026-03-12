<?php
namespace App\Services\Payroll;

use App\Mail\PayrollUpdate;
use App\Models\Attendance;
use App\Models\AttendancePolicy;
use App\Models\Employee;
use App\Models\Loan;
use App\Models\LoanInstallment;
use App\Models\Ot;
use App\Models\Payroll;
use App\Models\PayrollAdjustment;
use App\Models\PayrollRule;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PayrollService
{
    protected const STANDARD_HOURS_PER_DAY = 8;

    public function generateForEmployee($employee, $periodStart, $periodEnd)
    {
        $start = Carbon::parse($periodStart)->startOfDay();
        $end = Carbon::parse($periodEnd)->endOfDay();

        if ($start->gt($end)) {
            [$start, $end] = [$end->copy()->startOfDay(), $start->copy()->endOfDay()];
        }

        $totalDays = $start->copy()->startOfDay()->diffInDays($end->copy()->startOfDay()) + 1;

        if (Payroll::where('employee_id', $employee->id)
            ->whereDate('period_start', $start->toDateString())
            ->whereDate('period_end', $end->toDateString())
            ->exists()) {
            return null;
        }

        DB::beginTransaction();

        try {
            // Salary Component Extraction
            $salary                   = $employee->salaryData;
            $basic_salary             = $salary->basic_salary ?? 0;
            $house_rent               = $salary->house_rent ?? 0;
            $medical_allowance        = $salary->medical_allowance ?? 0;
            $dear_allowance           = $salary->dear_allowance ?? 0;
            $transport_allowance      = $salary->transport_allowance ?? 0;
            $pf_employer_contribution = $salary->pf_employer_contribution ?? 0;
            $other_allowance          = $salary->other_allowance ?? 0;

            $pf_employee_contribution = $salary->pf_employee_contribution ?? 0;
            $welfare_contribution     = $salary->welfare_contribution ?? 0;
            $tax_deduction            = $salary->tax_deduction ?? 0;

            $totalPlusSalary      = $basic_salary + $house_rent + $medical_allowance + $dear_allowance + $transport_allowance + $pf_employer_contribution + $other_allowance;
            $totalDeductionSalary = $welfare_contribution + $pf_employee_contribution + $tax_deduction;

            // Attendance Calculations
            $attendances = Attendance::where('employee_id', $employee->id)
                ->whereNotNull('status')
                ->whereBetween('date', [$start, $end])
                ->get();

            $leaveDays  = $attendances->where('status', 'leave')->count();
            $absentDays = $attendances->where('status', 'absent')->count();
            $holyDays   = $attendances->where('status', 'holiday')->count();
            $offDays    = $attendances->where('status', 'offday')->count();
            $lateDays   = $attendances->filter(fn($attendance) =>
                $attendance->status === 'late' || ((int) ($attendance->late_minutes ?? 0) > 0)
            )->count();

            $totalWorkingDays = max($totalDays - $offDays, 0);

            $attendancePolicy = $this->resolveAttendancePolicy($employee);
            $lateCutoffAbsentDays = $this->calculateLateCutoffAbsentDays($attendances, $attendancePolicy);

            $effectiveLateDays = max($lateDays - $lateCutoffAbsentDays, 0);

            // Late Deduction Policy (fallback to legacy field for backward compatibility)
            $latePenaltyThresholdDays = (int) (($attendancePolicy?->late_penalty_threshold_days ?? 0) ?: ($attendancePolicy?->late_deduction_count_days ?? 0));
            $latePenaltyDeductDays = (float) (($attendancePolicy?->late_penalty_deduct_days ?? 0) ?: 1);

            $latePenaltyDays = 0;
            if ($latePenaltyThresholdDays > 0) {
                $latePenaltyDays = floor($effectiveLateDays / $latePenaltyThresholdDays) * $latePenaltyDeductDays;
            }

            $totalAbsentForDeduction = $absentDays + $lateCutoffAbsentDays + $latePenaltyDays;
            $presentDays = max($totalDays - $leaveDays - $absentDays - $holyDays - $offDays - $lateCutoffAbsentDays, 0);

            $dailySalary     = round($totalPlusSalary / $totalDays, 2);
            $absentDeduction = $dailySalary * $totalAbsentForDeduction;

            // OT Calculation - overtime_minutes is stored as INTEGER (total minutes)
            $otConfig = Ot::query()
                ->where('branch_group_id', $employee->branch?->branch_group_id)
                ->latest('id')
                ->first();

            $totalOt = 0;
            if ($employee->has_ot && $otConfig && $otConfig->include_in_payroll) {
                $regularOvertimeMinutes = $attendances
                    ->whereNotIn('status', ['holiday', 'offday'])
                    ->sum('overtime_minutes');

                $holidayOvertimeMinutes = $attendances
                    ->whereIn('status', ['holiday', 'offday'])
                    ->sum('overtime_minutes');

                $payableOvertimeMinutes = $regularOvertimeMinutes;
                if ($otConfig->off_day_counting) {
                    $payableOvertimeMinutes += $holidayOvertimeMinutes;
                }

                $overTimeHour  = round($payableOvertimeMinutes / 60, 2);
                $otRatePerHour = $this->resolveOtRatePerHour(
                    $otConfig,
                    $employee,
                    $totalPlusSalary,
                    $totalDays
                );
                $totalOt = round($overTimeHour * $otRatePerHour, 2);
            }

            // Loan EMI - This modifies the Loan table, so Transaction is critical here!
            $loan = Loan::where('employee_id', $employee->id)
                ->where('remaining_amount', '>', 0)
                ->first();

            $loanDeduction = 0;
            if ($loan) {
                $loanDeduction           = $loan->emi_amount ?? $loan->monthly_installment;
                $loan->remaining_amount -= $loanDeduction;
                $loan->save();

                LoanInstallment::create([
                    'loan_id' => $loan->id,
                    'year'    => $end->year,
                    'month'   => $end->month,
                    'amount'  => $loanDeduction,
                    'is_paid' => 1, // 1 for paid, 0 for pending
                ]);
            }

            // Adjustments
            $adjustmentsAdvanced = PayrollAdjustment::where('employee_id', $employee->id)->where('type', 'advance')
                ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
                ->sum('amount');
            $adjustmentsAddition = PayrollAdjustment::where('employee_id', $employee->id)->where('type', 'addition')
                ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
                ->sum('amount');
            $adjustmentsDeduction = PayrollAdjustment::where('employee_id', $employee->id)->where('type', 'deduction')
                ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
                ->sum('amount');

            [$ruleBonusAmount, $ruleDeductionAmount] = $this->resolvePayrollRules(
                $employee,
                $start,
                $end,
                $presentDays,
                $totalWorkingDays,
                $basic_salary
            );

            $attendanceBonus = $this->resolveAttendanceBonusFromRules(
                $employee,
                $start,
                $end,
                $presentDays,
                $totalWorkingDays,
                $basic_salary,
                $totalAbsentForDeduction,
                $leaveDays
            );

            $totalPositiveAdjustments = $adjustmentsAddition + $ruleBonusAmount;
            $totalNegativeAdjustments = $adjustmentsDeduction + $adjustmentsAdvanced + $ruleDeductionAmount;

            $grossSalary = $totalPlusSalary + $totalOt + $attendanceBonus + $totalPositiveAdjustments;

            $totalDeduction = $totalDeductionSalary + $absentDeduction + $loanDeduction + $totalNegativeAdjustments;

            $netSalary = $grossSalary - $totalDeduction;

            $payroll = Payroll::create([
                'branch_id'            => $employee->branch_id,
                'employee_id'          => $employee->id,
                'period_start'         => $start->toDateString(),
                'period_end'           => $end->toDateString(),
                'total_days'           => $totalDays,
                'total_working_days'   => $totalWorkingDays,
                'present_days'         => $presentDays,
                'off_days'             => $offDays,
                'holy_days'            => $holyDays,
                'leave_days'           => $leaveDays,
                'absent_days'          => $absentDays,
                'late_days'            => $effectiveLateDays,
                'late_penalty_days'    => (int) round($latePenaltyDays),
                'per_day_salary'       => $dailySalary,
                'basic_salary'         => $basic_salary,
                'attendance_bonus'     => $attendanceBonus,
                'total_ot'             => $totalOt,
                'late_deduction'       => 0,
                'loan_deduction'       => $loanDeduction,
                'positive_adjustments' => $totalPositiveAdjustments,
                'negative_adjustments' => $totalNegativeAdjustments,
                'absent_deduction'     => $absentDeduction,
                'total_deduction'      => $totalDeduction,
                'gross_salary'         => $grossSalary,
                'net_salary'           => $netSalary,
                'is_generated'         => true,
                'approval_stage'       => 'branch_hr',
            ]);
            Mail::to($employee->email)->queue(new PayrollUpdate($payroll));
            DB::commit();
            return $payroll;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Payroll failed for Employee ID {$employee->id}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Generate payroll for all employees in a specific branch
     */
    public function generateForBranch($branchId, $periodStart, $periodEnd)
    {
        $employees = Employee::where('branch_id', $branchId)
            ->where('status', 1)
            ->get();

        $count = 0;

        foreach ($employees as $employee) {
            $result = $this->generateForEmployee($employee, $periodStart, $periodEnd);
            if ($result) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Generate payroll for all employees across all branches
     */
    public function generateForAllBranches($periodStart, $periodEnd)
    {
        $employees = Employee::where('status', 1)->get();

        $count = 0;

        foreach ($employees as $employee) {
            $result = $this->generateForEmployee($employee, $periodStart, $periodEnd);
            if ($result) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Generate payroll for all employees in a specific branch group
     */
    public function generateForBranchGroup($branchGroupId, $periodStart, $periodEnd)
    {
        $employees = Employee::query()
            ->where('status', 1)
            ->whereHas('branch', function ($q) use ($branchGroupId) {
                $q->where('branch_group_id', $branchGroupId);
            })
            ->get();

        $count = 0;

        foreach ($employees as $employee) {
            $result = $this->generateForEmployee($employee, $periodStart, $periodEnd);
            if ($result) {
                $count++;
            }
        }

        return $count;
    }

    public function resolveOtRatePerHour($otConfig, $employee, float $totalPlusSalary, int $totalDays): float
    {
        if (! $otConfig) {
            return 0;
        }

        $designationRate = $otConfig->rates()
            ->where('designation_id', $employee->designation_id)
            ->value('rate');

        if ($designationRate !== null) {
            return (float) $designationRate;
        }

        if (isset($otConfig->rate_type) && $otConfig->rate_type === 'percentage' && isset($otConfig->rate)) {
            $monthlyWorkHours = max($totalDays * self::STANDARD_HOURS_PER_DAY, 1);
            $baseHourlyRate   = $totalPlusSalary / $monthlyWorkHours;
            return round($baseHourlyRate * ((float) $otConfig->rate / 100), 2);
        }

        if (isset($otConfig->rate)) {
            return (float) $otConfig->rate;
        }

        return 0;
    }

    protected function resolveAttendancePolicy($employee): ?AttendancePolicy
    {
        return AttendancePolicy::query()
            ->where('status', 'active')
            ->where(function ($q) use ($employee) {
                $q->whereNull('branch_id')
                    ->orWhere('branch_id', $employee->branch_id);
            })
            ->orderByRaw('CASE WHEN branch_id IS NULL THEN 1 ELSE 0 END')
            ->latest('id')
            ->first();
    }

    protected function calculateLateCutoffAbsentDays(Collection $attendances, ?AttendancePolicy $policy): int
    {
        if (! $policy || ! $policy->mark_absent_if_late || empty($policy->late_cutoff_time)) {
            return 0;
        }

        $cutoff = strlen($policy->late_cutoff_time) === 5
            ? $policy->late_cutoff_time . ':00'
            : $policy->late_cutoff_time;

        return $attendances
            ->filter(function ($attendance) use ($cutoff) {
                if (! $attendance->clock_in || ! in_array($attendance->status, ['present', 'late'], true)) {
                    return false;
                }

                return $attendance->clock_in->format('H:i:s') > $cutoff;
            })
            ->count();
    }

    protected function resolvePayrollRules($employee, Carbon $periodStart, Carbon $periodEnd, int $presentDays, int $workingDays, float $basicSalary): array
    {
        $rules = PayrollRule::query()
            ->where('is_active', true)
            ->where(function ($q) use ($employee) {
                $q->whereNull('branch_group_id')
                    ->orWhere('branch_group_id', $employee->branch?->branch_group_id);
            })
            ->get();

        $totalBonus = 0.0;
        $totalDeduction = 0.0;

        foreach ($rules as $rule) {
            if ($this->isAttendanceBonusRule($rule)) {
                continue;
            }

            if (! $this->isRuleApplicable($rule, $periodStart, $periodEnd, $presentDays)) {
                continue;
            }

            $amount = $this->calculateRuleAmount($rule, $workingDays, $basicSalary);

            if ($amount <= 0) {
                continue;
            }

            if ($rule->type === 'deduction') {
                $totalDeduction += $amount;
            } else {
                $totalBonus += $amount;
            }
        }

        return [round($totalBonus, 2), round($totalDeduction, 2)];
    }

    protected function resolveAttendanceBonusFromRules(
        $employee,
        Carbon $periodStart,
        Carbon $periodEnd,
        int $presentDays,
        int $workingDays,
        float $basicSalary,
        float $totalAbsentForDeduction,
        int $leaveDays
    ): float {
        // Keep existing behavior: attendance bonus only when no absent/late penalty and no leave.
        if ($totalAbsentForDeduction > 0 || $leaveDays > 0) {
            return 0;
        }

        $rules = PayrollRule::query()
            ->where('is_active', true)
            ->where('type', 'bonus')
            ->where(function ($q) use ($employee) {
                $q->whereNull('branch_group_id')
                    ->orWhere('branch_group_id', $employee->branch?->branch_group_id);
            })
            ->get();

        $attendanceBonus = 0.0;

        foreach ($rules as $rule) {
            if (! $this->isAttendanceBonusRule($rule)) {
                continue;
            }

            if (! $this->isRuleApplicable($rule, $periodStart, $periodEnd, $presentDays)) {
                continue;
            }

            $attendanceBonus += $this->calculateRuleAmount($rule, $workingDays, $basicSalary);
        }

        return round($attendanceBonus, 2);
    }

    protected function isAttendanceBonusRule($rule): bool
    {
        return stripos((string) $rule->name, 'attendance bonus') !== false;
    }

    protected function isRuleApplicable($rule, Carbon $periodStart, Carbon $periodEnd, int $presentDays): bool
    {
        if ($rule->condition_type === 'min_present_days') {
            return $presentDays >= (int) $rule->condition_present_days;
        }

        if ($rule->condition_type === 'date_range') {
            if (! $rule->condition_from || ! $rule->condition_to) {
                return false;
            }

            $from = Carbon::parse($rule->condition_from)->startOfDay();
            $to = Carbon::parse($rule->condition_to)->endOfDay();

            return $periodStart->lte($to) && $periodEnd->gte($from);
        }

        return true;
    }

    protected function calculateRuleAmount($rule, int $workingDays, float $basicSalary): float
    {
        if ($rule->calc_type === 'percentage') {
            return round($basicSalary * ((float) $rule->value / 100), 2);
        }

        if ($rule->calc_type === 'per_day') {
            return round((float) $rule->value * $workingDays, 2);
        }

        return round((float) $rule->value, 2);
    }
}
