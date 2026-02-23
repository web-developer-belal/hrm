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
            ->whereDate('date', today())
            ->first();
    }

    /* =========================
       PUNCH IN
    ==========================*/
    public function punchIn()
    {
        $attendance = ModelsAttendance::firstOrCreate(
            [
                'employee_id' => $this->employee->id,
                'date'        => today(),
            ],
            [
                'branch_id'        => $this->employee->branch_id,
                'roster_id'        => $this->employee->rosters->first()->id,
                'shift_start_time' => $this->employee->shift->start_time ?? '09:00:00',
                'shift_end_time'   => $this->employee->shift->end_time ?? '17:00:00',
                'status'           => 'present',
            ]
        );

        if (! $attendance->clock_in) {

            $attendance->clock_in = now();

            $shiftStart = Carbon::parse(today()->format('Y-m-d') . ' ' . $attendance->shift_start_time);

            if (now()->gt($shiftStart)) {
                $attendance->late_minutes = $shiftStart->diffInMinutes(now());
                $attendance->status       = 'late';
            }

            $attendance->save();
        }

        $this->loadTodayAttendance();
    }

    /* =========================
       PUNCH OUT
    ==========================*/
    public function punchOut()
    {
        if (! $this->todayAttendance || ! $this->todayAttendance->clock_in) {
            return;
        }

        if (! $this->todayAttendance->clock_out) {

            $this->todayAttendance->clock_out = now();

            $shiftEnd = Carbon::parse(today()->format('Y-m-d') . ' ' . $this->todayAttendance->shift_end_time);

            if (now()->gt($shiftEnd)) {
                $this->todayAttendance->overtime_minutes =
                $shiftEnd->diffInMinutes(now());
            }

            if (now()->lt($shiftEnd)) {
                $this->todayAttendance->early_exit_minutes =
                now()->diffInMinutes($shiftEnd);
            }

            $this->todayAttendance->save();
        }

        $this->loadTodayAttendance();
    }

    /* =========================
       HELPER: Format Minutes
    ==========================*/
    private function formatMinutes($minutes)
    {
        $hours = floor($minutes / 60);
        $mins  = $minutes % 60;

        return "{$hours}h {$mins}m";
    }

    public function render()
    {
        $employeeId = $this->employee->id;

        $attendances = ModelsAttendance::where('employee_id', $employeeId)
            ->latest()
            ->paginate(10);

        /* =========================
           SUMMARY COUNTS
        ==========================*/
        $totalPresent = ModelsAttendance::where('employee_id', $employeeId)
            ->whereIn('status', ['present', 'late'])
            ->count();

        $totalAbsent = ModelsAttendance::where('employee_id', $employeeId)
            ->where('status', 'absent')
            ->count();

        $totalLate = ModelsAttendance::where('employee_id', $employeeId)
            ->where('status', 'late')
            ->count();

        $totalOnTime = ModelsAttendance::where('employee_id', $employeeId)
            ->where('status', 'present')
            ->count();

        $totalWorkingDays = ModelsAttendance::where('employee_id', $employeeId)
            ->count();

        /* =========================
           TODAY WORK CALCULATION
        ==========================*/
        $totalWorkingMinutes = 0;
        $overtimeMinutes     = 0;
        $breakMinutes        = 0; // if you track breaks later

        if ($this->todayAttendance && $this->todayAttendance->clock_in) {

            $clockOut = $this->todayAttendance->clock_out ?? now();

            $totalWorkingMinutes =
            Carbon::parse($this->todayAttendance->clock_in)
                ->diffInMinutes($clockOut);

            $overtimeMinutes = $this->todayAttendance->overtime_minutes ?? 0;
        }

        return view('livewire.employ.attendance', [
            'employee'          => $this->employee,
            'todayAttendance'   => $this->todayAttendance,
            'attendances'       => $attendances,

            'totalPresent'      => $totalPresent,
            'totalAbsent'       => $totalAbsent,
            'totalLate'         => $totalLate,
            'totalOnTime'       => $totalOnTime,
            'totalWorkingDays'  => $totalWorkingDays,

            'totalWorkingHours' => $this->formatMinutes($totalWorkingMinutes),
            'productivityHours' => $this->formatMinutes($totalWorkingMinutes - $overtimeMinutes),
            'breakHours'        => $this->formatMinutes($breakMinutes),
            'overtimeHours'     => $this->formatMinutes($overtimeMinutes),
        ]);
    }
}
