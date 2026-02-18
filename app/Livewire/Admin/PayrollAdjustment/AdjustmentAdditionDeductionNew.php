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

    public $employeesData = [];
    public $branches = [];
    public $departments = [];

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
    public $isSettled=0;


    public function mount($adjustment = null)
    {
        $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', '')->toArray();

        $this->departments = Department::where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();
        $this->employeesData = Employee::pluck('first_name', 'id')->prepend('Select Employee', '')->toArray();

        if ($adjustment) {
            $this->isEditMode = true;
            $this->adjustmentId = PayrollAdjustment::findOrFail($adjustment);
            $this->isSettled = $this->adjustmentId->is_settled;

            $this->employee_id = $this->adjustmentId->employee_id;
            $this->selectedBranch = $this->adjustmentId->branch_id;
            $this->selectedEmployee = $this->adjustmentId->employee_id;
            $this->selectedDepartment = $this->adjustmentId->employee->department_id;
            $this->selectedType = $this->adjustmentId->type;
            $this->amount = $this->adjustmentId->amount;
            $this->note = $this->adjustmentId->note;
            $this->date = $this->adjustmentId->date;
        }
    }



    public function updatedSelectedBranch()
    {
        $this->departments = Department::where('branch_id', $this->selectedBranch)->where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();
    }

    public function updatedselectedDepartment()
    {
        // dd($this->selectedDepartment);
        $this->employeesData = Employee::where('department_id', $this->selectedDepartment)->where('status', 1)->pluck('first_name', 'id')->prepend('Select Employee', '')->toArray();
    }


    public function saveAdjustment()
    {
        $this->validate();

        $date = Carbon::parse($this->date);
        $month = $date->month;
        $year  = $date->year;

        if($this->isEditMode==true)
        {
            $this->adjustmentId->update([
                'branch_id' => $this->selectedBranch,
                'employee_id' => $this->selectedEmployee,
                'type' => $this->selectedType,
                'amount' => $this->amount,
                'note' => $this->note,
                'year' => $year,
                'month' => $month,
                'date' => $this->date,
            ]);
        }else{
            PayrollAdjustment::create([
                'branch_id' => $this->selectedBranch,
                'employee_id' => $this->selectedEmployee,
                'type' => $this->selectedType,
                'amount' => $this->amount,
                'note' => $this->note,
                'year' => $year,
                'month' => $month,
                'date' => $this->date,
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
