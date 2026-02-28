<?php

namespace App\Livewire\Admin\Loan;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Loan;
use App\Models\LoanInstallment;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoanCreate extends Component
{

    public $isEditMode = false;

    public $employee_id;
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
    public $amount;

    #[Validate('required|numeric')]
    public $installment =1;
    #[Validate('required|numeric')]
    public $emiAmount;
    #[Validate('required|date')]
    public $startMonth;
    #[Validate('string|nullable')]
    public $note,$date;
    public $adjustmentId;
    public $isSettled=0;


    public function mount($adjustment = null)
    {
        $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', '')->toArray();

        $this->departments = Department::where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();
        $this->employeesData = Employee::pluck('first_name', 'id')->prepend('Select Employee', '')->toArray();

        if ($adjustment) {
            $this->isEditMode = true;
            $this->adjustmentId = Loan::findOrFail($adjustment);
            $this->isSettled = $this->adjustmentId->is_settled;

            $this->employee_id = $this->adjustmentId->employee_id;
            $this->selectedBranch = $this->adjustmentId->branch_id;
            $this->selectedEmployee = $this->adjustmentId->employee_id;
            $this->selectedDepartment = $this->adjustmentId->employee->department_id;

            $this->amount = $this->adjustmentId->amount;
            $this->note = $this->adjustmentId->note;
            $this->date = $this->adjustmentId->date;
        }
    }


    public function updatedSelectedBranch()
    {
        $this->departments = Department::where('branch_id', $this->selectedBranch)->where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();
    }

    public function updatedSelectedDepartment()
    {
        // dd($this->selectedDepartment);
        $this->employeesData = Employee::where('department_id', $this->selectedDepartment)->where('status', 1)->pluck('first_name', 'id')->prepend('Select Employee', '')->toArray();
    }

    public function updated()
    {
            $this->emiAmount = $this->amount / $this->installment;
    }


    public function saveLoan()
    {
        $this->validate();

        $date = Carbon::parse($this->startMonth);
        $month = $date->month;
        $year  = $date->year;

        $loan = Loan::create([
            'branch_id' => $this->selectedBranch,
            'employee_id' => $this->selectedEmployee,
            'amount' => $this->amount,
            'installments' => $this->installment,
            'emi_amount' =>$this->emiAmount,
            'remaining_amount' => $this->amount,
            'start_month' => $this->startMonth,
        ]);

        $start = Carbon::parse(time: $this->startMonth);

        for ($i = 0; $i < $this->installment; $i++) {

            LoanInstallment::create([
                'loan_id' => $loan->id,
                'year' => $start->copy()->addMonths($i)->year,
                'month' => $start->copy()->addMonths($i)->month,
                'amount' => $this->emiAmount,
            ]);
        }


        flash()->success($this->isEditMode ? 'Loan  updated successfully.' : 'Loan created successfully.');
        return redirect()->route('admin.loan.index');
    }

    public function render()
    {
        return view('livewire.admin.loan.loan-create');
    }
}
