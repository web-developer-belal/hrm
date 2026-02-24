<?php
namespace App\Livewire\Employ;

use App\Models\Attendance as ModelsAttendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Attendance extends Component
{
    use WithPagination;

    public $employee;
    public $todayAttendance;

    public function mount()
    {
        $this->employee = Auth::guard('employee')->user();
        $this->loadTodayAttendance();
    }

    public function loadTodayAttendance()
    {
        $this->todayAttendance = ModelsAttendance::where('employee_id', $this->employee->id)
            ->whereDate('date', Carbon::today())
            ->first();
    }

    public function getAttendanceData()
    {
        $employeeId = $this->employee->id;

        $present = ModelsAttendance::where('employee_id', $employeeId)
            ->where('status', 'present')
            ->count();

        $absent = ModelsAttendance::where('employee_id', $employeeId)
            ->where('status', 'absent')
            ->count();

        $late = ModelsAttendance::where('employee_id', $employeeId)
            ->where('status', 'late')
            ->count();

        $onTime = ModelsAttendance::where('employee_id', $employeeId)
            ->where('status', 'present')
            ->where('late_minutes', 0)
            ->count();

        $totalOvertimeMinutes = ModelsAttendance::where('employee_id', $employeeId)
            ->sum('overtime_minutes');

        $totalWorkingMinutes = ModelsAttendance::where('employee_id', $employeeId)
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

        $attendance = ModelsAttendance::where('date', $today)->first();

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
        $attendance = ModelsAttendance::where('employee_id', $this->employee->id)
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
        $employeeId = $this->employee->id;

        $attendances = ModelsAttendance::where('employee_id', $employeeId)
            ->latest()
            ->paginate(10);

        return view('livewire.employ.attendance', [
            'employee'        => $this->employee,
            'todayAttendance' => $this->todayAttendance,
            'attendances'     => $attendances,
            'attendanceData'  => $this->getAttendanceData(),
        ]);
    }
}
