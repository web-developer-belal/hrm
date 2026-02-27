<?php
namespace App\Livewire\Admin\Employees;

use App\Models\Employee;
use App\Models\Salary;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EmployeeDetails extends Component
{

    public $employee;
    public bool $salaryModalshow = false;

    #[Validate('required|numeric')]
    public $basicSalary = '';

    #[Validate('nullable|numeric')]
    public $houseRentPercent;
    #[Validate('nullable|numeric')]
    public $houseRentAmount;
    #[Validate('nullable|numeric')]
    public $medicalAllowancePercent;
    #[Validate('nullable|numeric')]
    public $medicalAllowanceAmount;
    #[Validate('nullable|numeric')]
    public $dearAllowancePercent;
    #[Validate('nullable|numeric')]
    public $dearAllowanceAmout;
    #[Validate('nullable|numeric')]
    public $transportAllowancePercent;
    #[Validate('nullable|numeric')]
    public $transportAllowanceAmount;
    #[Validate('nullable|numeric')]
    public $pfEployerContributionPercent;
    #[Validate('nullable|numeric')]
    public $pfEployerContributionAmount;
    #[Validate('nullable|numeric')]
    public $otherAllowancePercent;
    #[Validate('nullable|numeric')]
    public $otherAllowanceAmount;
    #[Validate('nullable|numeric')]
    public $pfEmployeeContributionPercent;
    #[Validate('nullable|numeric')]
    public $pfEmployeeContributionAmount;
    #[Validate('nullable|numeric')]
    public $welfareContributionPercnet;
    #[Validate('nullable|numeric')]
    public $welfareContributionAmount;
    #[Validate('nullable|numeric')]
    public $taxDeductionPercent;
    #[Validate('nullable|numeric')]
    public $taxDeductionAmount;

    public $basic_salary = 0;
    public $house_rent = 0;
    public $medical_allowance = 0;
    public $dear_allowance = 0;
    public $transport_allowance = 0;
    public $pf_employer_contribution = 0;
    public $other_allowance = 0;
    public $pf_employee_contribution = 0;
    public $welfare_contribution = 0;
    public $tax_deduction = 0;
    public $totalSalary = 0;

    public function mount($emp)
    {
        $this->employee = Employee::findorfail($emp);

        $salay = Salary::where('employee_id', $emp)->first();
        //  $this->totalSalary = $salay->basic_salary + $salay->house_rent +$salay->medical_allowance+$salay->dear_allowance +$salay->transport_allowance ;

        // $this->basic_salary= $this->employee->salaryData->basic_salary ?? null;
        // $this->house_rent= $this->employee->salaryData->house_rent ?? null;
        // $this->medical_allowance= $this->employee->salaryData->medical_allowance ?? null;
        // $this->dear_allowance= $this->employee->salaryData->dear_allowance ?? null;
        // $this->transport_allowance= $this->employee->salaryData->transport_allowance ?? null;
        // $this->pf_employer_contribution= $this->employee->salaryData->pf_employer_contribution ?? null;
        // $this->other_allowance= $this->employee->salaryData->other_allowance ?? null;
        // $this->pf_employee_contribution= $this->employee->salaryData->pf_employee_contribution ?? null;
        // $this->welfare_contribution= $this->employee->salaryData->welfare_contribution ?? null;
        // $this->tax_deduction= $this->employee->salaryData->tax_deduction ?? null;
        // $this->totalSalary= $this->employee->salaryData->basic_salary + $this->employee->salaryData->house_rent +$this->employee->salaryData->medical_allowance+$this->employee->salaryData->dear_allowance +$this->employee->salaryData->transport_allowance -  $this->employee->salaryData->pf_employee_contribution -$this->employee->salaryData->welfare_contribution -$this->employee->salaryData->tax_deduction ?? null;
        $this->basic_salary             = $this->employee->salaryData->basic_salary ?? 0;
        $this->house_rent               = $this->employee->salaryData->house_rent ?? 0;
        $this->medical_allowance        = $this->employee->salaryData->medical_allowance ?? 0;
        $this->dear_allowance           = $this->employee->salaryData->dear_allowance ?? 0;
        $this->transport_allowance      = $this->employee->salaryData->transport_allowance ?? 0;
        $this->pf_employer_contribution = $this->employee->salaryData->pf_employer_contribution ?? 0;
        $this->other_allowance          = $this->employee->salaryData->other_allowance ?? 0;
        $this->pf_employee_contribution = $this->employee->salaryData->pf_employee_contribution ?? 0;
        $this->welfare_contribution     = $this->employee->salaryData->welfare_contribution ?? 0;
        $this->tax_deduction            = $this->employee->salaryData->tax_deduction ?? 0;

        $this->totalSalary = $this->basic_salary
         + $this->house_rent
         + $this->medical_allowance
         + $this->dear_allowance
         + $this->transport_allowance
         - $this->pf_employee_contribution
         - $this->welfare_contribution
         - $this->tax_deduction;

    }

    public function addOrUpdateSalary()
    {
        $this->salaryModalshow = true;


    }
    public function addOrUpdateSalarySubmit()
    {

        $this->validate();

        Salary::updateOrCreate(
            ['employee_id' => $this->employee->id],
            [
                'branch_id'                => $this->employee->branch_id,
                'basic_salary'             => $this->basicSalary,
                'house_rent'               => $this->house_rent,
                'medical_allowance'        => $this->medical_allowance,
                'dear_allowance'           => $this->dear_allowance,
                'transport_allowance'      => $this->transport_allowance,
                'pf_employer_contribution' => $this->pf_employer_contribution,
                'other_allowance'          => $this->other_allowance,
                'pf_employee_contribution' => $this->pf_employee_contribution,
                'welfare_contribution'     => $this->welfare_contribution,
                'tax_deduction'            => $this->tax_deduction,
            ]
        );

        flash()->success('Salary created successfully.');

        $this->salaryModalshow = false;
    }

    public function updated()
    {
        // Optional: validate or sanitize
        $this->basic_salary             = $this->basicSalary;
        $this->house_rent               = $this->houseRentAmount ? $this->houseRentAmount : round($this->basicSalary / 100 * $this->houseRentPercent);
        $this->medical_allowance        = $this->medicalAllowanceAmount ? $this->medicalAllowanceAmount : round($this->basicSalary / 100 * $this->medicalAllowancePercent);
        $this->dear_allowance           = $this->dearAllowanceAmout ? $this->dearAllowanceAmout : round($this->basicSalary / 100 * $this->dearAllowanceAmout);
        $this->transport_allowance      = $this->transportAllowanceAmount ? $this->transportAllowanceAmount : round($this->basicSalary / 100 * $this->transportAllowancePercent);
        $this->pf_employer_contribution = $this->pfEployerContributionAmount ? $this->pfEployerContributionAmount : round($this->basicSalary / 100 * $this->pfEployerContributionPercent);
        $this->other_allowance          = $this->otherAllowanceAmount ? $this->otherAllowanceAmount : round($this->basicSalary / 100 * $this->otherAllowancePercent);
        $this->pf_employee_contribution = $this->pfEmployeeContributionAmount ? $this->pfEmployeeContributionAmount : round($this->basicSalary / 100 * $this->pfEmployeeContributionPercent);
        $this->welfare_contribution     = $this->welfareContributionAmount ? $this->welfareContributionAmount : round($this->basicSalary / 100 * $this->welfareContributionPercnet);
        $this->tax_deduction            = $this->taxDeductionAmount ? $this->taxDeductionAmount : round($this->basicSalary / 100 * $this->taxDeductionPercent);
        $this->totalSalary              = $this->basicSalary + $this->house_rent + $this->medical_allowance + $this->dear_allowance + $this->transport_allowance + $this->pf_employer_contribution + $this->other_allowance - $this->pf_employee_contribution - $this->welfare_contribution - $this->tax_deduction;

    }

    public function closeModal()
    {
        $this->salaryModalshow = false;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.employees.employee-details');
    }
}
