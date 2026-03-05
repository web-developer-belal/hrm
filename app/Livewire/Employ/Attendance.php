<?php
namespace App\Livewire\Employ;

use App\Models\Attendance as ModelsAttendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Attendance extends Component
{
    use WithPagination;

    public $employee;
    public $todayAttendance;
    public $search = '';
    public $startDate = null; // Set to null initially
    public $endDate = null;   // Set to null initially
    public $selectedStatus = null;
    public $statuses = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'startDate' => ['except' => null],
        'endDate' => ['except' => null],
    ];

    public function mount()
    {
        $this->employee = Auth::guard('employee')->user();
        $this->loadTodayAttendance();

        $this->statuses = [
            'late'  => 'Late',
            'present' => 'Present',
            'absent' => 'Absent',
            'leave' => 'Leave',
            'holiday' => 'Holiday',
            'offday' => 'Off Day',
        ];

        // Don't set default dates - keep them null to show all data
    }

    #[On('date-range-update')]
    public function updateDateRange($start, $end)
    {
        $this->startDate = $start;
        $this->endDate = $end;
        $this->resetPage();
    }

    // Add method to clear date filter
    public function clearDateFilter()
    {
        $this->startDate = null;
        $this->endDate = null;
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function filterByStatus($status)
    {
        $this->selectedStatus = $status;
        $this->resetPage();
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

        $attendance = ModelsAttendance::where('employee_id', $this->employee->id)
            ->where('date', $today)
            ->first();

        if (! $attendance) {
            flash()->error('No attendance record found for today');
            return;
        }

        if (! $attendance->clock_in) {
            $attendance->clock_in = $now;

            // Late calculation
            $shiftStart = Carbon::parse($attendance->date->format('Y-m-d') . ' ' . $attendance->shift_start_time);
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

            $shiftEnd = Carbon::parse($attendance->date->format('Y-m-d') . ' ' . $attendance->shift_end_time);

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
            ->when($this->search, function ($query) {
                $query->whereHas('employee', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->startDate && $this->endDate, function ($query) {
                // Only apply date filter if both dates are provided
                $query->whereBetween('date', [$this->startDate, $this->endDate]);
            })
            ->when($this->selectedStatus, function ($q) {
                $q->where('status', $this->selectedStatus);
            })
            ->latest('date')
            ->paginate(10);

        return view('livewire.employ.attendance', [
            'employee'        => $this->employee,
            'todayAttendance' => $this->todayAttendance,
            'attendances'     => $attendances,
            'attendanceData'  => $this->getAttendanceData(),
        ]);
    }
}
