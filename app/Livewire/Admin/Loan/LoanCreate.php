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

    public $employee;

    public $employee_id_options   = [];
    public $branch_id_options     = [];
    public $department_id_options = [];

    public $employee_id_search, $branch_id_search, $department_id_search;

    #[Validate('required|exists:branches,id')]
    public ?int $branch_id;

    #[Validate('required|exists:departments,id')]
    public ?int $department_id;

    #[Validate('required|exists:employees,id')]
    public $employee_id;
    #[Validate('required')]
    public $amount;

    #[Validate('required|numeric')]
    public $installment = 1;
    #[Validate('required|numeric')]
    public $emiAmount;
    #[Validate('required|date')]
    public $startMonth;
    #[Validate('string|nullable')]
    public $note, $date;
    public $adjustmentId;
    public $isSettled = 0;

    public function mount($adjustment = null)
    {
        $this->loadBranches();
        if ($adjustment) {
            $this->isEditMode   = true;
            $this->adjustmentId = Loan::findOrFail($adjustment);
            $this->isSettled    = $this->adjustmentId->is_settled;

            $this->employee      = $this->adjustmentId->employee;
            $this->branch_id     = $this->adjustmentId->branch_id;
            $this->employee_id   = $this->adjustmentId->employee_id;
            $this->department_id = $this->adjustmentId->employee->department_id;

            $this->amount        = $this->adjustmentId->amount;
            $this->note          = $this->adjustmentId->note;
            $this->date          = $this->adjustmentId->date;
            $this->department_id = $this->adjustmentId->employee->department_id;

            $this->loadDepartments();
            $this->loadEmployees();
        }
    }

    public function loadBranches()
    {
        $this->branch_id_options = Branch::whereHas('departments')->when($this->branch_id_search, function ($query) {
            $query->where('name', 'like', '%' . $this->branch_id_search . '%');
        })->where('status', 'active')->take(5)->pluck('name', 'id')->toArray();
    }

    public function loadDepartments()
    {
        if (! $this->branch_id) {
            $this->department_id_options = [];
            return;
        }
        $this->department_id_options = Department::whereHas('employees')->where('branch_id', $this->branch_id)->when($this->department_id_search, function ($query) {
            $query->where('name', 'like', '%' . $this->department_id_search . '%');
        })->where('status', 'active')->take(5)->pluck('name', 'id')->toArray();
    }

    public function loadEmployees()
    {
        if (! $this->department_id) {
            $this->employee_id_options = [];
            return;
        }
        $this->employee_id_options = Employee::where('department_id', $this->department_id)->when($this->employee_id_search, function ($query) {
            $query->where('first_name', 'like', '%' . $this->employee_id_search . '%')->orWhere('last_name', 'like', '%' . $this->employee_id_search . '%')->orWhere('employee_code', 'like', '%' . $this->employee_id_search . '%');
        })->where('status', 1)->take(5)->get()->mapWithKeys(function ($employee) {
            return [$employee->id => $employee->full_name . ' (' . $employee->employee_code . ')'];
        })->toArray();
    }

    public function updatedBranchId()
    {
        $this->department_id = null;
        $this->employee_id   = null;
        $this->loadDepartments();
    }

    public function updatedDepartmentId()
    {
        // dd($this->department_id);
        $this->employee_id = null;
        $this->loadEmployees();
    }

    public function updatedBranchIdSearch()
    {
        $this->loadBranches();
    }
    public function updatedDepartmentIdSearch()
    {
        $this->loadDepartments();
    }
    public function updatedEmployeeIdSearch()
    {
        $this->loadEmployees();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['amount', 'installment'])) {
            // Prevent division by zero
            if ($this->installment == 0) {
                $this->emiAmount = 0;
                return;
            }
            $this->emiAmount = floatval($this->amount ?? 0) / (int) ($this->installment ?? 1);
        }
    }

    public function saveLoan()
    {
        $this->validate();

        // $date  = Carbon::parse($this->startMonth);
        // $month = $date->month;
        // $year  = $date->year;

        $loan = Loan::create([
            'branch_id'        => $this->branch_id,
            'employee_id'      => $this->employee_id,
            'amount'           => $this->amount,
            'installments'     => $this->installment,
            'emi_amount'       => $this->emiAmount,
            'remaining_amount' => $this->amount,
            'start_month'      => $this->startMonth,
        ]);

        $start = Carbon::parse(time: $this->startMonth);

        for ($i = 0; $i < $this->installment; $i++) {

            LoanInstallment::create([
                'loan_id' => $loan->id,
                'year'    => $start->copy()->addMonths($i)->year,
                'month'   => $start->copy()->addMonths($i)->month,
                'amount'  => $this->emiAmount,
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
