<?php
namespace App\Livewire\Employ;

use App\Models\AttendancePolicy;
use App\Models\Attendance as ModelsAttendance;
use App\Models\Ot;
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
        
        $totalBreakMinutes = ModelsAttendance::where('employee_id', $employeeId)
            ->sum('in_grace_period_minutes') + 
            ModelsAttendance::where('employee_id', $employeeId)
            ->sum('out_grace_period_minutes');

        $totalWorkingMinutes = ModelsAttendance::where('employee_id', $employeeId)
            ->whereNotNull('clock_in')
            ->whereNotNull('clock_out')
            ->get()
            ->sum(function ($row) {
                return Carbon::parse($row->clock_in)
                    ->diffInMinutes(Carbon::parse($row->clock_out));
            });
        
        $productiveMinutes = max(0, $totalWorkingMinutes - $totalBreakMinutes);

        return [
            'present'           => $present,
            'absent'            => $absent,
            'late'              => $late,
            'on_time'           => $onTime,
            'working_hours'     => $this->formatMinutes($totalWorkingMinutes),
            'productive_hours'  => $this->formatMinutes($productiveMinutes),
            'break_hours'       => $this->formatMinutes($totalBreakMinutes),
            'overtime'          => $this->formatMinutes($totalOvertimeMinutes),
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

            $attendancePolicy = $this->resolveAttendancePolicy();
            $attendance->in_grace_period_minutes = (int) ($attendancePolicy?->in_grace_period_minutes ?? 0);
            $attendance->out_grace_period_minutes = (int) ($attendancePolicy?->out_grace_period_minutes ?? 0);

            if ($attendance->shift_start_time) {
                $shiftStart = Carbon::parse($attendance->date)
                    ->setTimeFromTimeString($attendance->shift_start_time);
                $graceShiftStart = $shiftStart->copy()->addMinutes((int) ($attendancePolicy?->in_grace_period_minutes ?? 0));

                $attendance->late_minutes = 0;
                if ($now->gt($graceShiftStart)) {
                    $attendance->late_minutes = $graceShiftStart->diffInMinutes($now);

                    $isAfterCutoff = false;
                    if ($attendancePolicy && $attendancePolicy->mark_absent_if_late && ! empty($attendancePolicy->late_cutoff_time)) {
                        $cutoffTime = strlen((string) $attendancePolicy->late_cutoff_time) === 5
                            ? $attendancePolicy->late_cutoff_time . ':00'
                            : $attendancePolicy->late_cutoff_time;

                        $cutoffDateTime = Carbon::parse($attendance->date)->setTimeFromTimeString($cutoffTime);
                        $isAfterCutoff = $now->gt($cutoffDateTime);
                    }

                    $attendance->status = $isAfterCutoff ? 'absent' : 'late';
                } else {
                    $attendance->status = 'present';
                }
            } else {
                $attendance->status = 'present';
                $attendance->late_minutes = 0;
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

            $attendance->overtime_minutes = 0;
            if ($attendance->shift_end_time && $attendance->clock_out && $this->canCountOvertime($attendance)) {
                $shiftEnd = Carbon::parse($attendance->date)->setTimeFromTimeString($attendance->shift_end_time);

                if ($attendance->clock_out->gt($shiftEnd)) {
                    $attendance->overtime_minutes = $shiftEnd->diffInMinutes($attendance->clock_out);
                }
            }

            $attendance->save();
        }

        $this->loadTodayAttendance();
    }

    protected function resolveAttendancePolicy(): ?AttendancePolicy
    {
        return AttendancePolicy::query()
            ->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('branch_id')
                    ->orWhere('branch_id', $this->employee->branch_id);
            })
            ->orderByRaw('CASE WHEN branch_id IS NULL THEN 1 ELSE 0 END')
            ->latest('id')
            ->first();
    }

    protected function canCountOvertime(ModelsAttendance $attendance): bool
    {
        if (! $this->employee->has_ot) {
            return false;
        }

        $otConfig = Ot::query()
            ->where('branch_group_id', $this->employee->branch?->branch_group_id)
            ->latest('id')
            ->first();

        if (! $otConfig || ! $otConfig->include_in_payroll) {
            return false;
        }

        if (! $otConfig->off_day_counting && in_array((string) $attendance->status, ['holiday', 'offday'], true)) {
            return false;
        }

        return $otConfig->rates()
            ->where('designation_id', $this->employee->designation_id)
            ->exists();
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
            ->whereDate('date', '<=', today())
            ->latest('date')
            ->paginate(10);
        
        // Calculate shift seconds for circular progress
        $shiftSeconds = 9 * 3600; // 9 hour default shift
        
        if ($this->todayAttendance && $this->todayAttendance->shift_start_time) {
            $shiftMinutes = Carbon::parse($this->todayAttendance->shift_start_time)
                ->diffInMinutes(Carbon::parse($this->todayAttendance->shift_end_time));
            $shiftSeconds = $shiftMinutes * 60;
        }

        return view('livewire.employ.attendance', [
            'employee'        => $this->employee,
            'todayAttendance' => $this->todayAttendance,
            'attendances'     => $attendances,
            'attendanceData'  => $this->getAttendanceData(),
            'todayAttendanceForCircle' => $this->todayAttendance,
            'shiftSeconds' => $shiftSeconds,
        ]);
    }
}
