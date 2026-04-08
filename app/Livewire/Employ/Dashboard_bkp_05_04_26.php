<?php
namespace App\Livewire\Employ;

use App\Models\Attendance;
use App\Models\AttendancePolicy;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\Notice;
use App\Models\Ot;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use function Flasher\Prime\flash;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Dashboard extends Component
{
    public $employee;
    public $todayAttendance;

    public $startDate = null;
    public $endDate   = null;

    public $todayBirthdayEmployees = [];
    public $holidays               = [];

    public function mount()
    {
        $this->employee               = Auth::guard('employee')->user();
        $this->todayBirthdayEmployees = Employee::whereMonth('date_of_birth', Carbon::now()->month)
            ->whereDay('date_of_birth', Carbon::now()->day)
            ->where('branch_id', $this->employee->branch_id)
            ->where('department_id', $this->employee->department_id)
            ->where('id', '!=', $this->employee->id)
            ->get();

        // Get upcoming holidays (today and future)
        $this->holidays = Holiday::where('branch_id', $this->employee->branch_id)
            ->whereDate('date', '>=', Carbon::today())
            ->orderBy('date', 'asc')
            ->take(10)
            ->get();

        $this->loadTodayAttendance();
        $this->startDate = Carbon::now()->startOfMonth()->toDateString();
        $this->endDate   = Carbon::now()->endOfMonth()->toDateString();
    }

    #[On('date-range-update')]
    public function updateDateRange($start, $end)
    {
        $this->startDate = $start;
        $this->endDate   = $end;
        // $this->resetPage();
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
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->count();

        $absent = Attendance::where('employee_id', $employeeId)
            ->where('status', 'absent')
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->count();

        $late = Attendance::where('employee_id', $employeeId)
            ->where('status', 'late')
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->count();

        $onTime = Attendance::where('employee_id', $employeeId)
            ->where('status', 'present')
            ->where('late_minutes', 0)
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->count();

        $totalOvertimeMinutes = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->sum('overtime_minutes');
    
        // Get previous period for comparison (last month)
        $prevStart = Carbon::parse($this->startDate)->subMonth()->startOfMonth()->toDateString();
        $prevEnd = Carbon::parse($this->startDate)->subMonth()->endOfMonth()->toDateString();

        $prevPresent = Attendance::where('employee_id', $employeeId)
            ->where('status', 'present')
            ->whereBetween('date', [$prevStart, $prevEnd])
            ->count();

        $prevAbsent = Attendance::where('employee_id', $employeeId)
            ->where('status', 'absent')
            ->whereBetween('date', [$prevStart, $prevEnd])
            ->count();

        $prevLate = Attendance::where('employee_id', $employeeId)
            ->where('status', 'late')
            ->whereBetween('date', [$prevStart, $prevEnd])
            ->count();

        $prevOnTime = Attendance::where('employee_id', $employeeId)
            ->where('status', 'present')
            ->where('late_minutes', 0)
            ->whereBetween('date', [$prevStart, $prevEnd])
            ->count();

        $totalBreakMinutes = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->sum('in_grace_period_minutes') +
        Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->sum('out_grace_period_minutes');

        $totalWorkingMinutes = Attendance::where('employee_id', $employeeId)
            ->whereNotNull('clock_in')
            ->whereNotNull('clock_out')
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->get()
            ->sum(function ($row) {
                return Carbon::parse($row->clock_in)
                    ->diffInMinutes(Carbon::parse($row->clock_out));
            });

        $productiveMinutes = max(0, $totalWorkingMinutes - $totalBreakMinutes);

        // Calculate percentage changes
        $presentChange = $prevPresent > 0 ? round((($present - $prevPresent) / $prevPresent) * 100) : ($present > 0 ? 100 : 0);
        $absentChange = $prevAbsent > 0 ? round((($absent - $prevAbsent) / $prevAbsent) * 100) : ($absent > 0 ? 100 : 0);
        $lateChange = $prevLate > 0 ? round((($late - $prevLate) / $prevLate) * 100) : ($late > 0 ? 100 : 0);
        $onTimeChange = $prevOnTime > 0 ? round((($onTime - $prevOnTime) / $prevOnTime) * 100) : ($onTime > 0 ? 100 : 0);

        return [
            'present'          => $present,
            'absent'           => $absent,
            'late'             => $late,
            'on_time'          => $onTime,
            'present_change'   => $presentChange,
            'absent_change'    => $absentChange,
            'late_change'      => $lateChange,
            'on_time_change'   => $onTimeChange,
            'working_hours'    => $this->formatMinutes($totalWorkingMinutes),
            'productive_hours' => $this->formatMinutes($productiveMinutes),
            'break_hours'      => $this->formatMinutes($totalBreakMinutes),
            'overtime'         => $this->formatMinutes($totalOvertimeMinutes),
        ];
    }
    public function getLeaveData()
    {
        $employeeId = $this->employee->id;

        $total = Leave::where('employee_id', $employeeId)
            ->where('from_date', '>=', $this->startDate)
            ->where('to_date', '<=', $this->endDate)
            ->count();

        $absent = Attendance::where('employee_id', $employeeId)
            ->where('status', 'absent')
            ->where('date', '>=', $this->startDate)
            ->where('date', '<=', $this->endDate)
            ->count();

        $taken = Leave::where('employee_id', $employeeId)
            ->where('status', 'approved')
            ->where('from_date', '>=', $this->startDate)
            ->where('to_date', '<=', $this->endDate)
            ->count();

        $request = Leave::where('employee_id', $employeeId)
            ->where('status', 'pending')
            ->where('from_date', '>=', $this->startDate)
            ->where('to_date', '<=', $this->endDate)
            ->count();

        $lossOfPay = 0;

        $workingDays = Attendance::where('employee_id', $employeeId)
            ->whereNotNull('clock_in')
            ->whereNotNull('clock_out')
            ->whereBetween('date', [$this->startDate, $this->endDate])
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

    private function getPerformanceChartData(): array
    {
        $start = Carbon::parse($this->startDate);
        $end   = Carbon::parse($this->endDate);

        if ($start->gt($end)) {
            [$start, $end] = [$end, $start];
        }

        $attendanceByDate = Attendance::where('employee_id', $this->employee->id)
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->get()
            ->keyBy(fn($item) => Carbon::parse($item->date)->toDateString());

        $categories = [];
        $series     = [];

        foreach (CarbonPeriod::create($start, $end) as $date) {
            $dateKey      = $date->toDateString();
            $categories[] = $date->format('d M');

            $minutes = 0;
            $record  = $attendanceByDate->get($dateKey);

            if ($record && $record->clock_in && $record->clock_out) {
                $minutes = Carbon::parse($record->clock_in)
                    ->diffInMinutes(Carbon::parse($record->clock_out));
            }

            $series[] = round($minutes / 60, 2);
        }

        return [
            'categories' => $categories,
            'series' => $series,
        ];
    }

    public function punchIn()
    {
        $today = Carbon::today();
        $now   = Carbon::now();

        $attendance = Attendance::where('employee_id', $this->employee->id)
            ->whereDate('date', $today)
            ->first();

        if (! $attendance) {
            flash()->info('Not found attendance');
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
            flash()->success('Punched in successfully.');
        } else {
            flash()->warning('You have already punched in today.');
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

            $attendance->overtime_minutes = 0;
            if ($attendance->shift_end_time && $attendance->clock_out && $this->canCountOvertime($attendance)) {
                $shiftEnd = Carbon::parse($attendance->date)->setTimeFromTimeString($attendance->shift_end_time);
                if ($attendance->clock_out->gt($shiftEnd)) {
                    $attendance->overtime_minutes = $shiftEnd->diffInMinutes($attendance->clock_out);
                }
            }

            $attendance->save();
            flash()->success('Punched out successfully.');
        } else {
            flash()->warning('You have not punched in today or already punched out.');
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

    protected function canCountOvertime(Attendance $attendance): bool
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
        $notices = Notice::where('department_id', $this->employee->department_id)
            ->orWhere('branch_id', $this->employee->branch_id)
            ->whereBetween('created_at', [$this->startDate . ' 00:00:00', $this->endDate . ' 23:59:59'])
            ->take(7)
            ->get();

        $attendanceData = $this->getAttendanceData();
        $leaveData      = $this->getLeaveData();
        $performanceChartData = $this->getPerformanceChartData();

        // Get today's attendance for real-time circle data
        $todayAttendanceForCircle = $this->todayAttendance;
        $shiftSeconds             = 9 * 3600; // 9 hour default shift

        if ($todayAttendanceForCircle && $todayAttendanceForCircle->shift_start_time) {
            $shiftMinutes = Carbon::parse($todayAttendanceForCircle->shift_start_time)
                ->diffInMinutes(Carbon::parse($todayAttendanceForCircle->shift_end_time));
            $shiftSeconds = $shiftMinutes * 60;
        }

        return view('livewire.employ.dashboard', [
            'notices'                  => $notices,
            'attendanceData'           => $attendanceData,
            'leaveData'                => $leaveData,
            'performanceChartData'     => $performanceChartData,
            'todayBirthdayEmployees'   => $this->todayBirthdayEmployees,
            'holidays'                 => $this->holidays,
            'todayAttendanceForCircle' => $todayAttendanceForCircle,
            'shiftSeconds'             => $shiftSeconds,
        ]);
    }
}
