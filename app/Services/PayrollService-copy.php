<?php

namespace App\Services;

use App\Models\Payroll;
use App\Models\Attendance;
use App\Models\PayrollAdjustment;
use App\Models\LoanInstallment;
use App\Models\Holiday;
use App\Models\Roster;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;

class PayrollService
{
    public function generate($employee, $year, $month)
    {
        // 🔒 Check Lock
        $existing = Payroll::where('employee_id',$employee->id)
            ->where('year',$year)
            ->where('month',$month)
            ->first();

        if($existing && $existing->is_locked){
            throw new \Exception('Payroll already locked.');
        }

        $basicSalary = $employee->salary;

        // =========================
        // Attendance Collection
        // =========================

        $attendances = Attendance::where('employee_id',$employee->id)
            ->whereYear('date',$year)
            ->whereMonth('date',$month)
            ->get();

        $totalLateMinutes = $attendances->sum('late_minutes');
        $totalOtMinutes   = $attendances->sum('overtime_minutes');

        $lateCountDays = $attendances->where('late_minutes','>',0)->count();

        // =========================
        // Late Deduction (Per Minute)
        // =========================

        $perMinuteSalary = $basicSalary / 30 / 8 / 60;
        $lateDeduction = $totalLateMinutes * $perMinuteSalary;

        // =========================
        // 4 Late = 1 Absent Policy
        // =========================

        $extraAbsentFromLate = intdiv($lateCountDays, 4);

        $perDaySalary = $basicSalary / 30;
        $absentDeductionFromLate = $extraAbsentFromLate * $perDaySalary;

        // =========================
        // Overtime Calculation (1.5x)
        // =========================

        $hourlyRate = $basicSalary / 30 / 8;
        $totalOt = ($totalOtMinutes / 60) * ($hourlyRate * 1.5);

        // =========================
        // Loan EMI Deduction
        // =========================

        $loanDeduction = LoanInstallment::whereHas('loan', function($q) use ($employee){
                $q->where('employee_id',$employee->id);
            })
            ->where('year',$year)
            ->where('month',$month)
            ->where('is_paid',0)
            ->sum('amount');

        // =========================
        // Manual Adjustments
        // =========================

        $adjustments = PayrollAdjustment::where('employee_id',$employee->id)
            ->where('year',$year)
            ->where('month',$month)
            ->where('is_settled',0)
            ->sum(DB::raw("
                CASE
                    WHEN type='addition' THEN amount
                    WHEN type='deduction' THEN -amount
                END
            "));

        // =========================
        // Attendance Bonus
        // =========================

        $attendanceBonus = $this->calculateAttendanceBonus(
            $employee,
            $year,
            $month,
            $extraAbsentFromLate
        );

        // =========================
        // Final Calculation
        // =========================

        $grossSalary = $basicSalary
                        + $totalOt
                        + $adjustments
                        + $attendanceBonus;

        $netSalary = $grossSalary
                        - $lateDeduction
                        - $loanDeduction
                        - $absentDeductionFromLate;

        return Payroll::updateOrCreate(
            [
                'employee_id'=>$employee->id,
                'year'=>$year,
                'month'=>$month
            ],
            [
                'branch_id'=>$employee->branch_id,
                'basic_salary'=>$basicSalary,
                'total_ot'=>$totalOt,
                'late_deduction'=>$lateDeduction,
                'loan_deduction'=>$loanDeduction,
                'adjustments'=>$adjustments,
                'attendance_bonus'=>$attendanceBonus,
                'gross_salary'=>$grossSalary,
                'net_salary'=>$netSalary,
                'status'=>'draft',
                'approval_stage'=>'branch_hr',
                'is_locked'=>0
            ]
        );
    }

    // =========================
    // Attendance Bonus Logic
    // =========================

    private function calculateAttendanceBonus($employee,$year,$month,$extraAbsentFromLate)
    {
        if($extraAbsentFromLate > 0){
            return 0;
        }

        $roster = Roster::where('employee_id',$employee->id)
            ->first();

        if(!$roster) return 0;

        $workingDays = json_decode($roster->working_days,true) ?? [];
        $weeklyOffDays = json_decode($roster->weekly_off_days,true) ?? [];

        $period = CarbonPeriod::create(
            Carbon::create($year,$month,1),
            Carbon::create($year,$month,1)->endOfMonth()
        );

        $requiredDays = 0;

        foreach($period as $date){

            $dayName = strtolower($date->format('l'));

            $isHoliday = Holiday::whereDate('date',$date)
                ->where(function($q) use ($employee){
                    $q->whereNull('branch_id')
                      ->orWhere('branch_id',$employee->branch_id);
                })->exists();

            if(
                in_array($dayName,$workingDays) &&
                !in_array($dayName,$weeklyOffDays) &&
                !$isHoliday
            ){
                $requiredDays++;
            }
        }

        $presentDays = Attendance::where('employee_id',$employee->id)
            ->whereYear('date',$year)
            ->whereMonth('date',$month)
            ->where('status','Present')
            ->count();

        if($presentDays == $requiredDays){
            return 1000; // Fixed bonus
        }

        return 0;
    }
}
