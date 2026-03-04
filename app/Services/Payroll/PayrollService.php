<?php
namespace App\Services\Payroll;
use App\Models\Attendance;
use App\Models\AttendancePolicy;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Loan;
use App\Models\Payroll;
use App\Models\PayrollAdjustment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PayrollService
{
    public function generateForEmployee($employee, $year, $month, $totalDays)
    {

        if (Payroll::where('employee_id', $employee->id)
            ->where('year', $year)
            ->where('month', $month)
            ->exists()) {
            return null;
        }


        DB::beginTransaction();

        try {
            $start = Carbon::create($year, $month)->startOfMonth();
            $end   = Carbon::create($year, $month)->endOfMonth();

            // Salary Component Extraction
            $salary = $employee->salaryData;
            $basic_salary = $salary->basic_salary ?? 0;
            $house_rent = $salary->house_rent ?? 0;
            $medical_allowance = $salary->medical_allowance ?? 0;
            $dear_allowance = $salary->dear_allowance ?? 0;
            $transport_allowance = $salary->transport_allowance ?? 0;
            $pf_employer_contribution = $salary->pf_employer_contribution ?? 0;
            $other_allowance = $salary->other_allowance ?? 0;

            $pf_employee_contribution = $salary->pf_employee_contribution ?? 0;
            $welfare_contribution = $salary->welfare_contribution ?? 0;
            $tax_deduction = $salary->tax_deduction ?? 0;

            $totalPlusSalary = $basic_salary + $house_rent + $medical_allowance + $dear_allowance + $transport_allowance + $pf_employer_contribution + $other_allowance;
            $totalDeductionSalary = $welfare_contribution + $pf_employee_contribution + $tax_deduction;

            // Attendance Calculations
            $attendances = Attendance::where('employee_id', $employee->id)
                ->whereBetween('date', [$start, $end])
                ->get();

            $leaveDays  = $attendances->where('status', 'leave')->count();
            $absentDays = $attendances->where('status', 'absent')->count();
            $holyDays   = $attendances->where('status', 'holiyday')->count();
            $offDays    = $attendances->where('status', 'offday')->count();
            $lateDays   = $attendances->where('is_late', 1)->count();

            $totalWorkingDays = $totalDays - $offDays;
            $presentDays = $totalDays - $leaveDays - $absentDays - $holyDays - $offDays;

            // Late Deduction Policy
            $attendancePolicy = AttendancePolicy::where('status', 'active')->first();
            $lateDaysLimit = ($attendancePolicy && $attendancePolicy->late_deduction_count_days > 0)
                             ? $attendancePolicy->late_deduction_count_days
                             : 999; // Avoid division by zero

            $extraAbsent = floor($lateDays / $lateDaysLimit);
            $totalAbsentForDeduction = $absentDays + $extraAbsent;

            $dailySalary = round($totalPlusSalary / $totalDays);
            $absentDeduction = $dailySalary * $totalAbsentForDeduction;

            // OT Calculation
            $totalSeconds = $attendances->sum(function ($attendance) {
                if (!$attendance->overtime_minutes || !str_contains($attendance->overtime_minutes, ':')) return 0;
                [$hours, $minutes, $seconds] = explode(':', $attendance->overtime_minutes);
                return ($hours * 3600) + ($minutes * 60) + $seconds;
            });

            $overTimeHour = round($totalSeconds / 3600, 2);
            $totalOt = $overTimeHour * 50; // OT Rate

            // Loan EMI - This modifies the Loan table, so Transaction is critical here!
            $loan = Loan::where('employee_id', $employee->id)
                ->where('remaining_amount', '>', 0)
                ->first();

            $loanDeduction = 0;
            if ($loan) {
                $loanDeduction = min($loan->monthly_installment, $loan->remaining_amount);
                $loan->decrement('remaining_amount', $loanDeduction);
        $basic_salary             = $employee->salaryData->basic_salary ?? 0;
        $house_rent               = $employee->salaryData->house_rent ?? 0;
        $medical_allowance        = $employee->salaryData->medical_allowance ?? 0;
        $dear_allowance           = $employee->salaryData->dear_allowance ?? 0;
        $transport_allowance      = $employee->salaryData->transport_allowance ?? 0;
        $pf_employer_contribution = $employee->salaryData->pf_employer_contribution ?? 0;
        $other_allowance          = $employee->salaryData->other_allowance ?? 0;
        $pf_employee_contribution = $employee->salaryData->pf_employee_contribution ?? 0;
        $welfare_contribution     = $employee->salaryData->welfare_contribution ?? 0;
        $tax_deduction            = $employee->salaryData->tax_deduction ?? 0;
        $totalPlusSalary          = $basic_salary + $house_rent + $medical_allowance + $dear_allowance + $transport_allowance + $pf_employer_contribution + $other_allowance;
        $totalDeductionSalary     = $welfare_contribution + $pf_employee_contribution + $tax_deduction;

        $attendances = Attendance::where('employee_id', $employee->id)
            ->whereBetween('date', [$start, $end])
            ->get();
        $leaveDays        = $attendances->where('status', 'leave')->count();
        $absentDays       = $attendances->where('status', 'absent')->count();
        $holyDays         = $attendances->where('status', 'holiday')->count();
        $offDays          = $attendances->where('status', 'offday')->count();
        $lateDays         = $attendances->where('status', 'late')->count();
        $totalWorkingDays = $totalDays - $offDays - $holyDays;
        $presentDays      = $attendances->where('status', 'present')->count();

        // 4 days Late = 1 Absent
        $extraAbsent = floor($lateDays / 4);
        $totalAbsent = $absentDays + $extraAbsent;
        
        // Remaining lates that didn't convert to full absent day
        $remainingLates = $lateDays % 4;

        // Salary per day
        $dailySalary = round($totalPlusSalary / $totalDays, 2);

        $absentDeduction = $dailySalary * $totalAbsent;
        
        // Penalty for remaining late days (proportional deduction)
        $lateDeduction = ($dailySalary / 4) * $remainingLates;

        // OT - overtime_minutes is stored as INTEGER (total minutes)
        $totalOvertimeMinutes = $attendances->sum('overtime_minutes');
        
        // Convert total minutes to hours
        $overTimeHour = round($totalOvertimeMinutes / 60, 2);

        // Calculate OT amount (50 per hour)
        $totalOt = $overTimeHour * 50;

        // Loan EMI
        $loan = Loan::where('employee_id', $employee->id)
            ->where('remaining_amount', '>', 0)
            ->first();

        $loanDeduction = 0;
        if ($loan) {
            $loanDeduction           = $loan->emi_amount;
            $loan->remaining_amount -= $loanDeduction;
            $loan->save();
        }

        // Adjustments
        $adjustmentsAdvanced = PayrollAdjustment::where('employee_id', $employee->id)->where('type', 'advance')
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');
        $adjustmentsAddition = PayrollAdjustment::where('employee_id', $employee->id)->where('type', 'addition')
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');
        $adjustmentsDeduction = PayrollAdjustment::where('employee_id', $employee->id)->where('type', 'deduction')
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');

        //  Attendance Bonus (no absent, no leave)
        $attendanceBonus = 0;
        if ($totalAbsent == 0) {
            $attendanceBonus = 500;
        }

        $grossSalary = $totalPlusSalary + $totalOt + $attendanceBonus + $adjustmentsAddition;

        $totalDeduction = $totalDeductionSalary + $absentDeduction + $lateDeduction + $loanDeduction + $adjustmentsDeduction + $adjustmentsAdvanced;

        $netSalary = $grossSalary - $totalDeduction;

        return Payroll::create([
            'branch_id'            => $employee->branch_id,
            'employee_id'          => $employee->id,
            'year'                 => $year,
            'month'                => $month,
            'total_days'           => $totalDays,
            'total_working_days'   => $totalWorkingDays,
            'present_days'         => $presentDays,
            'off_days'             => $offDays,
            'holy_days'            => $holyDays,
            'leave_days'           => $leaveDays,
            'absent_days'          => $absentDays,
            'late_days'            => $lateDays,
            'late_penalty_days'    => $extraAbsent,
            'per_day_salary'       => $dailySalary,
            'basic_salary'         => $basic_salary,
            'attendance_bonus'     => $attendanceBonus,
            'total_ot'             => $totalOt,
            'late_deduction'       => $lateDeduction,
            'loan_deduction'       => $loanDeduction,
            'positive_adjustments' => $adjustmentsAddition,
            'negative_adjustments' => $adjustmentsDeduction + $adjustmentsAdvanced,
            'absent_deduction'     => $absentDeduction,
            'total_deduction'      => $totalDeduction,
            'gross_salary'         => $grossSalary,
            'net_salary'           => $netSalary,
            'is_generated'         => true,
            'approval_stage'       => 'branch_hr',
        ]);
    }

    /**
     *  Generate for Branch Individuals
     */
    public function generateForBranch($branchId, $year, $month, $totalDays)
    {
        // status 1 for active 0 for inactive
        $employees = Employee::where('branch_id', $branchId)
            ->where('status', 1)
            ->get();

        $count = 0;

        foreach ($employees as $employee) {
            $result = $this->generateForEmployee($employee, $year, $month, $totalDays);
            if ($result) {
                $count++;
            }

            // Adjustments
            $adjustments = PayrollAdjustment::where('employee_id', $employee->id)
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->get();

            $adv = $adjustments->where('type', 'advance')->sum('amount');
            $add = $adjustments->where('type', 'addition')->sum('amount');
            $ded = $adjustments->where('type', 'deduction')->sum('amount');

            $attendanceBonus = ($totalAbsentForDeduction == 0) ? 500 : 0;

            $grossSalary = $totalPlusSalary + $totalOt + $attendanceBonus + $add;
            $totalDeduction = $totalDeductionSalary + $absentDeduction + $loanDeduction + $ded + $adv;
            $netSalary = $grossSalary - $totalDeduction;

            $payroll = Payroll::create([
                'branch_id'           => $employee->branch_id,
                'employee_id'         => $employee->id,
                'year'                => $year,
                'month'               => $month,
                'total_days'          => $totalDays,
                'total_working_days'  => $totalWorkingDays,
                'present_days'        => $presentDays,
                'off_days'            => $offDays,
                'holy_days'           => $holyDays,
                'leave_days'          => $leaveDays,
                'absent_days'         => $absentDays,
                'late_days'           => $lateDays,
                'late_penalty_days'   => $extraAbsent,
                'per_day_salary'      => $dailySalary,
                'basic_salary'        => $basic_salary,
                'attendance_bonus'    => $attendanceBonus,
                'total_ot'            => $totalOt,
                'late_deduction'      => 0,
                'loan_deduction'      => $loanDeduction,
                'positive_adjustments'=> $add,
                'negative_adjustments'=> $ded + $adv,
                'absent_deduction'    => $absentDeduction,
                'total_deduction'     => $totalDeduction,
                'gross_salary'        => $grossSalary,
                'net_salary'          => $netSalary,
                'is_generated'        => true,
                'approval_stage'      => 'branch_hr',
            ]);

            DB::commit();
            return $payroll;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Payroll failed for Employee ID {$employee->id}: " . $e->getMessage());
            return null;
        }
    }


    /**
     *  Generate for ALL Branches
     */
    public function generateForAllBranches($year, $month, $totalDays)
    {
        // status 1 for active 0 for inactive
        $employees = Employee::where('status', 1)->get();

        $count = 0;

        foreach ($employees as $employee) {
            $result = $this->generateForEmployee($employee, $year, $month, $totalDays);
            if ($result) {
                $count++;
            }
        }

        return $count;
    }
}
