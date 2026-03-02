<?php

namespace App\Livewire\Admin\Attendance;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Validate;

class AddManualAttendance extends Component
{
    /* ===============================
        Dropdown Options
    =============================== */
    public array $selectedBranch_options = [];
    public array $selectedDepartment_options = ['' => 'Select Department'];
    public array $selectedEmployee_options = ['' => 'Select Employee'];

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
            ->where('status', 'active')
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    protected function loadDepartments(): void
    {
        if (! $this->selectedBranch) {
            $this->selectedDepartment_options = ['' => 'Select Department'];
            return;
        }

        $this->selectedDepartment_options = Department::query()
            ->where('branch_id', $this->selectedBranch)
            ->where('status', 'active')
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    protected function loadEmployees(): void
    {
        if (! $this->selectedBranch && ! $this->selectedEmployee_search) {
            $this->selectedEmployee_options = ['' => 'Select Employee'];
            return;
        }

        $this->selectedEmployee_options = Employee::query()
            ->when($this->selectedBranch, fn ($q) =>
                $q->where('branch_id', $this->selectedBranch)
            )
            ->when($this->selectedDepartment, fn ($q) =>
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
            ->mapWithKeys(fn ($employee) => [
                $employee->id => $employee->full_name . ' (' . $employee->employee_code . ')'
            ])
            ->toArray();
    }

    /* ===============================
        Search Handlers (NO resets!)
    =============================== */

    public function updatedSelectedBranchSearch(): void
    {
        $this->selectedBranch_options = Branch::query()
            ->where('status', 'active')
            ->when($this->selectedBranch_search, fn ($q) =>
                $q->where('name', 'like', '%' . $this->selectedBranch_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedSelectedDepartmentSearch(): void
    {
        if (! $this->selectedBranch) {
            $this->selectedDepartment_options = ['' => 'Select Department'];
            return;
        }

        $this->selectedDepartment_options = Department::query()
            ->where('branch_id', $this->selectedBranch)
            ->where('status', 'active')
            ->when($this->selectedDepartment_search, fn ($q) =>
                $q->where('name', 'like', '%' . $this->selectedDepartment_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
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
        $this->selectedEmployee = null;

        $this->selectedDepartment_search = null;
        $this->selectedEmployee_search = null;

        $this->loadDepartments();
    }

    public function updatedSelectedDepartment(): void
    {
        $this->selectedEmployee = null;
        $this->selectedEmployee_search = null;

        $this->loadEmployees();
    }


    public function render()
    {
        return view('livewire.admin.attendance.add-manual-attendance');
    }
}