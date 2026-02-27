<?php

namespace App\Services\Attendance;
use App\Models\Attendance;
use App\Models\AttendanceLog;
use Carbon\Carbon;
use App\Models\Leave;
use App\Models\Holiday;


class AttendanceProcessService
{
    public function process($employeeId, $date)
    {
        $attendance = Attendance::where('employee_id', $employeeId)
            ->where('date', $date)
            ->first();

        if (!$attendance) {
            return;
        }

        $branchId = $attendance->branch_id;

    //   Holiday check
        $isHoliday = Holiday::where('branch_id', $branchId)
            ->where('date', $date)
            ->exists();

        if ($isHoliday) {
            $attendance->update([
                'status' => 'holiday',
                'clock_in' => null,
                'clock_out' => null,
                'late_minutes' => 0,
                'early_exit_minutes' => 0,
                'overtime_minutes' => 0,
            ]);
            return;
        }

    //    Leave Check
        $isLeave = Leave::where('employee_id', $employeeId)
            ->where('status', 'approved')
            ->whereDate('from_date', '<=', $date)
            ->whereDate('to_date', '>=', $date)
            ->exists();

        if ($isLeave) {
            $attendance->update([
                'status' => 'leave',
                'clock_in' => null,
                'clock_out' => null,
                'late_minutes' => 0,
                'early_exit_minutes' => 0,
                'overtime_minutes' => 0,
            ]);
            return;
        }

     // Offday Check
        if (!$attendance->shift_start_time || !$attendance->shift_end_time) {
            $attendance->update([
                'status' => 'offday'
            ]);
            return;
        }

   // Get Device Log
       $logs = AttendanceLog::where('employee_id', $employeeId)
    ->where('attendance_date', $date)
    ->orderBy('attendance_time')
    ->get();

        if ($logs->isEmpty()) {
            $attendance->update([
                'status' => 'absent',
                'clock_in' => null,
                'clock_out' => null,
                'late_minutes' => 0,
                'early_exit_minutes' => 0,
                'overtime_minutes' => 0,
            ]);
            return;
        }

    $firstPunch = Carbon::parse($logs->first()->attendance_date)
    ->setTimeFromTimeString($logs->first()->attendance_time);

$lastPunch = Carbon::parse($logs->last()->attendance_date)
    ->setTimeFromTimeString($logs->last()->attendance_time);

$shiftStart = Carbon::parse($attendance->date)
    ->setTimeFromTimeString($attendance->shift_start_time);

$shiftEnd = Carbon::parse($attendance->date)
    ->setTimeFromTimeString($attendance->shift_end_time);

// Night shift handling
if ($shiftEnd->lessThan($shiftStart)) {
    $shiftEnd->addDay();
}

if ($lastPunch->lessThan($shiftStart)) {
    $lastPunch->addDay();
}

        $lateMinutes = 0;
        $earlyExitMinutes = 0;
        $overtimeMinutes = 0;
        $status = 'present';

       // Late Calculation
        if ($firstPunch->greaterThan($shiftStart)) {
            $lateMinutes = $shiftStart->diffInMinutes($firstPunch);
            $status = 'late';
        }

   // Early Exit Calculation
        if ($lastPunch->lessThan($shiftEnd)) {
            $earlyExitMinutes = $lastPunch->diffInMinutes($shiftEnd);
            $status = 'early exit';
        }

    // Overtime Calculation
        if ($lastPunch->greaterThan($shiftEnd)) {
            $overtimeMinutes = $shiftEnd->diffInMinutes($lastPunch);
        }

// Update Attendace Record
        $attendance->update([
            'clock_in' => $firstPunch->format('H:i:s'),
            'clock_out' => $lastPunch->format('H:i:s'),
            'late_minutes' => $lateMinutes,
            'early_exit_minutes' => $earlyExitMinutes,
            'overtime_minutes' => $overtimeMinutes,
            'status' => $status,
        ]);
    }
}
