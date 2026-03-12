<?php
namespace App\Livewire\Admin\Attendance;

use App\Models\AttendancePolicy;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Ot;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddManualAttendance extends Component
{
    /* ===============================
        Dropdown Options
    =============================== */
    public array $selectedBranch_options     = [];
    public array $selectedDepartment_options = ['' => 'Select Department'];
    public array $selectedEmployee_options   = ['' => 'Select Employee'];

    /* ===============================
        Selected Values
    =============================== */
    #[Validate('required|exists:branches,id')]
    public ?int $selectedBranch = null;

    #[Validate('nullable|exists:departments,id')]
    public ?int $selectedDepartment = null;

    #[Validate('required|exists:employees,id')]
    public ?int $selectedEmployee = null;

    #[Validate('required')]
    public $attandenceTime;

    #[Validate('required')]
    public $clockInOut;

    /* ===============================
        Search Inputs (KEEP _search)
    =============================== */
    public ?string $selectedBranch_search = null;
    public ?string $selectedDepartment_search = null;
    public ?string $selectedEmployee_search = null;

    public function mount()
    {
        $this->loadBranches();
    }

    /* ===============================
        Loaders
    =============================== */

    protected function loadBranches(): void
    {
        $this->selectedBranch_options = Branch::query()
            ->whereHas('departments')
            ->when($this->selectedBranch_search, function ($q) {
                $q->where('name', 'like', '%' . $this->selectedBranch_search . '%');
            })
            ->where('status', 'active')
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    protected function loadDepartments(): void
    {
        $this->selectedDepartment_options = Department::query()
            ->when($this->selectedBranch, fn($q) => $q->where('branch_id', $this->selectedBranch))
            ->when($this->selectedDepartment_search, function ($q) {
                $q->where('name', 'like', '%' . $this->selectedDepartment_search . '%');
            })
            ->where('status', 'active')
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    protected function loadEmployees(): void
    {
        if (! $this->selectedBranch && ! $this->selectedDepartment) {
            $this->selectedEmployee_options = ['' => 'Select Employee'];
            return;
        }

        $this->selectedEmployee_options = Employee::query()
            ->when($this->selectedBranch, fn($q) =>
                $q->where('branch_id', $this->selectedBranch)
            )
            ->when($this->selectedDepartment, fn($q) =>
                $q->where('department_id', $this->selectedDepartment)
            )
            ->where('status', 1)
            ->when($this->selectedEmployee_search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('first_name', 'like', '%' . $this->selectedEmployee_search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->selectedEmployee_search . '%')
                        ->orWhere('employee_code', 'like', '%' . $this->selectedEmployee_search . '%');
                });
            })
            ->limit(5)
            ->get()
            ->mapWithKeys(fn($employee) => [
                $employee->id => $employee->full_name . ' (' . $employee->employee_code . ')',
            ])
            ->toArray();
    }

    /* ===============================
        Search Handlers (NO resets!)
    =============================== */

    public function updatedSelectedBranchSearch(): void
    {
        $this->loadBranches();
    }

    public function updatedSelectedDepartmentSearch(): void
    {
        $this->loadDepartments();
    }

    public function updatedSelectedEmployeeSearch(): void
    {
        $this->loadEmployees();
    }

    /* ===============================
        Selection Handlers (SAFE resets)
    =============================== */

    public function updatedSelectedBranch(): void
    {
        $this->selectedDepartment = null;
        $this->selectedEmployee   = null;
        $this->loadDepartments();
    }

    public function updatedSelectedDepartment(): void
    {
        $this->selectedEmployee        = null;
        $this->loadEmployees();
    }

    public function saveManualAttendance()
    {
        $this->validate();
        $employee = Employee::find($this->selectedEmployee);
        $attendancePolicy = $this->resolveAttendancePolicy($employee);
        // get attendace date from attandence time
        $attendanceDate = \Carbon\Carbon::parse($this->attandenceTime)->toDateString();
        $punchTime = Carbon::parse($this->attandenceTime);
        // get that date attendance record if exists
        $attendance = $employee->attendances()->whereDate('date', $attendanceDate)->first();
        if(! $attendance) {
            $roster = $employee->rosters()
                ->whereDate('start_date', '<=', $attendanceDate)
                ->whereDate('end_date', '>=', $attendanceDate)
                ->first();

            $attendance = $employee->attendances()->create([
                'branch_id' => $employee->branch_id,
                'roster_id' => $roster?->id,
                'date' => $attendanceDate,
                'shift_start_time' => $employee->shift?->start_time ?? null,
                'shift_end_time' => $employee->shift?->end_time ?? null,
                'in_grace_period_minutes' => (int) ($attendancePolicy?->in_grace_period_minutes ?? 0),
                'out_grace_period_minutes' => (int) ($attendancePolicy?->out_grace_period_minutes ?? 0),
                'clock_in' => $this->clockInOut === 'clock_in' ? $punchTime : null,
                'clock_out' => $this->clockInOut === 'clock_out' ? $punchTime : null,
                'status' => 'present',
                'is_manually_edited' => true,
            ]);

            if($this->clockInOut === 'clock_in') {
                $this->applyClockInPolicy($attendance, $attendancePolicy, $punchTime);
            }

            if($this->clockInOut === 'clock_out') {
                $this->applyClockOutPolicy($attendance, $employee);
            }
        } else {
            $attendance->in_grace_period_minutes = (int) ($attendancePolicy?->in_grace_period_minutes ?? 0);
            $attendance->out_grace_period_minutes = (int) ($attendancePolicy?->out_grace_period_minutes ?? 0);

            if($this->clockInOut === 'clock_in') {
                $attendance->clock_in = $punchTime;
                $this->applyClockInPolicy($attendance, $attendancePolicy, $punchTime);
            } else {
                $attendance->clock_out = $punchTime;
                $this->applyClockOutPolicy($attendance, $employee);
            }
        }
        flash()->success('Manual attendance added successfully!');
        return redirect()->route('admin.attendance.index');
    }

    protected function resolveAttendancePolicy(Employee $employee): ?AttendancePolicy
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

    protected function applyClockInPolicy($attendance, ?AttendancePolicy $attendancePolicy, Carbon $punchTime): void
    {
        $attendance->is_manually_edited = true;

        if (! $attendance->shift_start_time) {
            $attendance->status = 'present';
            $attendance->late_minutes = 0;
            $attendance->save();
            return;
        }

        $shiftStart = Carbon::parse($attendance->date)->setTimeFromTimeString($attendance->shift_start_time);
        $graceShiftStart = $shiftStart->copy()->addMinutes((int) ($attendancePolicy?->in_grace_period_minutes ?? 0));

        $attendance->late_minutes = 0;
        if ($punchTime->gt($graceShiftStart)) {
            $attendance->late_minutes = $graceShiftStart->diffInMinutes($punchTime);

            $isAfterCutoff = false;
            if ($attendancePolicy && $attendancePolicy->mark_absent_if_late && ! empty($attendancePolicy->late_cutoff_time)) {
                $cutoffTime = strlen((string) $attendancePolicy->late_cutoff_time) === 5
                    ? $attendancePolicy->late_cutoff_time . ':00'
                    : $attendancePolicy->late_cutoff_time;

                $cutoffDateTime = Carbon::parse($attendance->date)->setTimeFromTimeString($cutoffTime);
                $isAfterCutoff = $punchTime->gt($cutoffDateTime);
            }

            $attendance->status = $isAfterCutoff ? 'absent' : 'late';
        } else {
            $attendance->status = 'present';
        }

        $attendance->save();
    }

    protected function applyClockOutPolicy($attendance, Employee $employee): void
    {
        $attendance->is_manually_edited = true;
        $attendance->overtime_minutes = 0;

        if (! $attendance->clock_out || ! $attendance->shift_end_time || ! $this->canCountOvertime($attendance, $employee)) {
            $attendance->save();
            return;
        }

        $shiftEnd = Carbon::parse($attendance->date)->setTimeFromTimeString($attendance->shift_end_time);
        if ($attendance->clock_out->gt($shiftEnd)) {
            $attendance->overtime_minutes = $shiftEnd->diffInMinutes($attendance->clock_out);
        }

        $attendance->save();
    }

    protected function canCountOvertime($attendance, Employee $employee): bool
    {
        if (! $employee->has_ot) {
            return false;
        }

        $otConfig = Ot::query()
            ->where('branch_group_id', $employee->branch?->branch_group_id)
            ->latest('id')
            ->first();

        if (! $otConfig || ! $otConfig->include_in_payroll) {
            return false;
        }

        if (! $otConfig->off_day_counting && in_array((string) $attendance->status, ['holiday', 'offday'], true)) {
            return false;
        }

        return $otConfig->rates()
            ->where('designation_id', $employee->designation_id)
            ->exists();
    }

    public function render()
    {
        return view('livewire.admin.attendance.add-manual-attendance');
    }
}
