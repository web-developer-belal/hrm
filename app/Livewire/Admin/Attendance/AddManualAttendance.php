<?php
namespace App\Livewire\Admin\Attendance;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
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
        // get attendace date from attandence time
        $attendanceDate = \Carbon\Carbon::parse($this->attandenceTime)->toDateString();
        // get that date attendance record if exists
        $attendance = $employee->attendances()->whereDate('date', $attendanceDate)->first();
        if(! $attendance) {
            $attendance = $employee->attendances()->create([
                'branch_id' => $employee->branch_id,
                'roster_id' => $employee->rosters()->whereDate('start_date', '<=', $attendanceDate)->whereDate('end_date', '>=', $attendanceDate)->first()->id ?? null,
                'date' => $attendanceDate,
                'shift_start_time' => $employee->shift?->start_time ?? null,
                'shift_end_time' => $employee->shift?->end_time ?? null,
                'clock_in' => $this->clockInOut === 'clock_in' ? Carbon::parse($this->attandenceTime) : null,
                'clock_out' => $this->clockInOut === 'clock_out' ? Carbon::parse($this->attandenceTime) : null,
                'status' => 'present',
                'is_manually_edited' => true,
            ]);
        } else {
            if($this->clockInOut === 'clock_in') {
                $attendance->update([
                    'clock_in' => Carbon::parse($this->attandenceTime),
                    'is_manually_edited' => true,
                ]);
            } else {
                $attendance->update([
                    'clock_out' => Carbon::parse($this->attandenceTime),
                    'is_manually_edited' => true,
                ]);
            }
        }
        flash()->success('Manual attendance added successfully!');
        return redirect()->route('admin.attendance.index');
    }

    public function render()
    {
        return view('livewire.admin.attendance.add-manual-attendance');
    }
}
