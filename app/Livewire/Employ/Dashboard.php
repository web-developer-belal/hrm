<?php
namespace App\Livewire\Employ;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Notice;
use Carbon\Carbon;
use function Flasher\Prime\flash;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $employee;
    public $todayAttendance;

    public function mount()
    {
        $this->employee = Auth::guard('employee')->user();
        $this->loadTodayAttendance();
    }

    public function loadTodayAttendance()
    {
        $this->todayAttendance = Attendance::where('employee_id', $this->employee->id)
            ->whereDate('date', Carbon::today())
            ->first();
    }

    public function getAttendanceData()
    {
        $employeeId = $this->employee->id;

        $present = Attendance::where('employee_id', $employeeId)
            ->where('status', 'present')
            ->count();

        $absent = Attendance::where('employee_id', $employeeId)
            ->where('status', 'absent')
            ->count();

        $late = Attendance::where('employee_id', $employeeId)
            ->where('status', 'late')
            ->count();

        $onTime = Attendance::where('employee_id', $employeeId)
            ->where('status', 'present')
            ->where('late_minutes', 0)
            ->count();

        $totalOvertimeMinutes = Attendance::where('employee_id', $employeeId)
            ->sum('overtime_minutes');

        $totalWorkingMinutes = Attendance::where('employee_id', $employeeId)
            ->whereNotNull('clock_in')
            ->whereNotNull('clock_out')
            ->get()
            ->sum(function ($row) {
                return Carbon::parse($row->clock_in)
                    ->diffInMinutes(Carbon::parse($row->clock_out));
            });

        return [
            'present'       => $present,
            'absent'        => $absent,
            'late'          => $late,
            'on_time'       => $onTime,
            'working_hours' => $this->formatMinutes($totalWorkingMinutes),
            'overtime'      => $this->formatMinutes($totalOvertimeMinutes),
        ];
    }
    public function getLeaveData()
    {
        $employeeId = $this->employee->id;

        $total = Leave::where('employee_id', $employeeId)
            
            ->count();

        $absent = Attendance::where('employee_id', $employeeId)
            ->where('status', 'absent')
            ->count();

        $taken = Leave::where('employee_id', $employeeId)
            ->where('status', 'approved')
            ->count();

        $request = Leave::where('employee_id', $employeeId)
            ->where('status', 'pending')
            ->count();

        $lossOfPay = 0;

        $workingDays = Attendance::where('employee_id', $employeeId)
            ->whereNotNull('clock_in')
            ->whereNotNull('clock_out')
            ->count();

        return [
            'total'       => $total,
            'absent'      => $absent,
            'taken'       => $taken,
            'request'     => $request,
            'lossOfPay'   => $lossOfPay,
            'workingDays' => $workingDays,
        ];
    }

    private function formatMinutes($minutes)
    {
        $hours = floor($minutes / 60);
        $mins  = $minutes % 60;
        return "{$hours}h {$mins}m";
    }

    public function punchIn()
    {
        $today = Carbon::today();
        $now   = Carbon::now();

        $attendance = Attendance::where('date', $today)->first();

        if (! $attendance) {
            flash()->error('Not found attendance');
            return;
        }

        if (! $attendance->clock_in) {
            $attendance->clock_in = $now;

            // Late calculation
            $shiftStart = Carbon::parse($attendance->date)
                ->setTimeFromTimeString($attendance->shift_start_time);
            if ($now->gt($shiftStart)) {
                $attendance->late_minutes = $shiftStart->diffInMinutes($now);
                $attendance->status       = 'late';
            } else {
                $attendance->status = 'present';
            }

            $attendance->save();
        }

        $this->loadTodayAttendance();
    }

    public function punchOut()
    {
        $attendance = Attendance::where('employee_id', $this->employee->id)
            ->whereDate('date', Carbon::today())
            ->first();

        if ($attendance && ! $attendance->clock_out) {

            $attendance->clock_out = Carbon::now();

            $shiftEnd = Carbon::parse($attendance->date . ' ' . $attendance->shift_end_time);

            if ($attendance->clock_out->gt($shiftEnd)) {
                $attendance->overtime_minutes =
                $shiftEnd->diffInMinutes($attendance->clock_out);
            }

            $attendance->save();
        }

        $this->loadTodayAttendance();
    }

    public function render()
    {
        $notices = Notice::where('department_id', $this->employee->department_id)
            ->orWhere('branch_id', $this->employee->branch_id)
            ->take(7)
            ->get();

        $attendanceData = $this->getAttendanceData();
        $leaveData      = $this->getLeaveData();

        return view('livewire.employ.dashboard', compact('notices', 'attendanceData', 'leaveData'));
    }
}
