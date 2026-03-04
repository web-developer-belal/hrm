<?php
namespace App\Livewire\Admin\PayrollAdjustment;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\PayrollAdjustment;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AdjustmentAdditionDeductionNew extends Component
{
    public $isEditMode = false;

    #[Validate('required|exists:branches,id')]
    public ?int $selectedBranch;

    #[Validate('required|exists:branches,id')]
    public ?int $selectedDepartment;

    #[Validate('required|exists:employees,id')]
    public $selectedEmployee;
    #[Validate('required')]
    public $selectedType;
    #[Validate('required')]
    public $amount;
    #[Validate('required|date')]
    public $date;
    #[Validate('string|nullable')]
    public $note;
    public $adjustmentId;
    public $isSettled = 0;
    public $employee_id;

    public $selectedEmployee_options = [];
    public $selectedBranch_options = [];
    public $selectedDepartment_options = [];

    public $selectedBranch_search;
    public $selectedDepartment_search;
    public $selectedEmployee_search;

    public function mount($adjustment = null)
    {
        $this->loadBranches();

        if ($adjustment) {
            $this->isEditMode   = true;
            $this->adjustmentId = PayrollAdjustment::findOrFail($adjustment);
            $this->isSettled    = $this->adjustmentId->is_settled;
            $this->employee_id        = $this->adjustmentId->employee_id;
            $this->selectedBranch     = $this->adjustmentId->branch_id;
            $this->selectedEmployee   = $this->adjustmentId->employee_id;
            $this->selectedDepartment = $this->adjustmentId->employee->department_id;
            $this->selectedType       = $this->adjustmentId->type;
            $this->amount             = $this->adjustmentId->amount;
            $this->note               = $this->adjustmentId->note;
            $this->date               = $this->adjustmentId->date;
            $this->loadDepartments();
            $this->loadEmployees();
        }
    }

    private function loadBranches()
    {
        $this->selectedBranch_options = Branch::whereHas('departments')->when($this->selectedBranch_search, function ($query) {
            $query->where('name', 'like', '%' . $this->selectedBranch_search . '%');
        })->where('status', 'active')->take(5)->pluck('name', 'id')->toArray();
    }

    private function loadDepartments()
    {
        if ($this->selectedBranch) {
            $this->selectedDepartment_options = Department::whereHas('employees')->when($this->selectedDepartment_search, function ($query) {
                $query->where('name', 'like', '%' . $this->selectedDepartment_search . '%');
            })->where('branch_id', $this->selectedBranch)->where('status', 'active')->take(5)->pluck('name', 'id')->toArray();
        } else {
            $this->selectedDepartment_options = [];
        }
    }

    private function loadEmployees()
    {
        if ($this->selectedDepartment) {
            $this->selectedEmployee_options = Employee::when($this->selectedEmployee_search, function ($query) {
                $query->where('first_name', 'like', '%' . $this->selectedEmployee_search . '%')->orWhere('last_name', 'like', '%' . $this->selectedEmployee_search . '%')->orWhere('employee_code', 'like', '%' . $this->selectedEmployee_search . '%');
            })->where('department_id', $this->selectedDepartment)->where('status', 1)->take(5)->get()->mapWithKeys(function ($employee) {
                return [$employee->id => $employee->full_name];
            })->toArray();
        } else {
            $this->selectedEmployee_options = [];
        }
    }

    public function updatedSelectedBranchSearch()
    {
        $this->loadBranches();
    }

    public function updatedSelectedDepartmentSearch()
    {
        $this->loadDepartments();
    }

    public function updatedSelectedEmployeeSearch()
    {
        $this->loadEmployees();
    }

    public function updatedSelectedBranch()
    {
        $this->selectedDepartment = null;
        $this->selectedEmployee   = null;
        $this->loadDepartments();
        $this->loadEmployees();
    }

    public function updatedSelectedDepartment()
    {
        $this->selectedEmployee = null;
        $this->loadEmployees();
    }

    public function saveAdjustment()
    {
        $this->validate();

        $date  = Carbon::parse($this->date);
        $month = $date->month;
        $year  = $date->year;

        if ($this->isEditMode == true) {
            $this->adjustmentId->update([
                'branch_id'   => $this->selectedBranch,
                'employee_id' => $this->selectedEmployee,
                'type'        => $this->selectedType,
                'amount'      => $this->amount,
                'note'        => $this->note,
                'year'        => $year,
                'month'       => $month,
                'date'        => $this->date,
            ]);
        } else {
            PayrollAdjustment::create([
                'branch_id'   => $this->selectedBranch,
                'employee_id' => $this->selectedEmployee,
                'type'        => $this->selectedType,
                'amount'      => $this->amount,
                'note'        => $this->note,
                'year'        => $year,
                'month'       => $month,
                'date'        => $this->date,
            ]);
        }

        flash()->success($this->isEditMode ? 'Adjustment  updated successfully.' : 'Adjustment created successfully.');
        return redirect()->route('admin.adjustment.index');
    }

    public function render()
    {
        return view('livewire.admin.payroll-adjustment.adjustment-addition-deduction-new');
    }
}
