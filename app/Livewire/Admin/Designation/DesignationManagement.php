<?php
namespace App\Livewire\Admin\Designation;

use App\Models\Designation;
use App\Models\SalaryTemplate;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class DesignationManagement extends Component
{
    use WithPagination;

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


    public $basic_salary =0;
    public $house_rent =0;
    public $medical_allowance =0;
    public $dear_allowance =0;
    public $transport_allowance =0;
    public $pf_employer_contribution =0;
    public $other_allowance =0;
    public $pf_employee_contribution =0;
    public $welfare_contribution =0;
    public $tax_deduction =0;
    public $totalSalary =0;

    public $designation;

    public function addOrUpdateSalary($designationid)
    {
            // dd($designationid);
        $this->designation = Designation::findorfail($designationid);

         $salary = SalaryTemplate::where('designation_id',$designationid)->first();

$this->basic_salary = $salary->basic_salary ?? 0;
$this->house_rent = $salary->house_rent ?? 0;
$this->medical_allowance = $salary->medical_allowance ?? 0;
$this->dear_allowance = $salary->dear_allowance ?? 0;
$this->transport_allowance = $salary->transport_allowance ?? 0;
$this->pf_employer_contribution = $salary->pf_employer_contribution ?? 0;
$this->other_allowance = $salary->other_allowance ?? 0;
$this->pf_employee_contribution = $salary->pf_employee_contribution ?? 0;
$this->welfare_contribution = $salary->welfare_contribution ?? 0;
$this->tax_deduction = $salary->tax_deduction ?? 0;

$this->totalSalary = $this->basic_salary
    + $this->house_rent
    + $this->medical_allowance
    + $this->dear_allowance
    + $this->transport_allowance
    - $this->pf_employee_contribution
    - $this->welfare_contribution
    - $this->tax_deduction;
    $this->salaryModalshow = true;
    }


    public function addOrUpdateSalarySubmit()
    {

        $this->validate();

        SalaryTemplate::updateOrCreate(
            ['designation_id' => $this->designation ->id],
            [
                'basic_salary' =>$this->basicSalary,
                'house_rent' =>$this->house_rent,
                'medical_allowance' =>$this->medical_allowance,
                'dear_allowance' =>$this->dear_allowance,
                'transport_allowance' =>$this->transport_allowance,
                'pf_employer_contribution' =>$this->pf_employer_contribution,
                'other_allowance' =>$this->other_allowance,
                'pf_employee_contribution' =>$this->pf_employee_contribution,
                'welfare_contribution' =>$this->welfare_contribution,
                'tax_deduction' =>$this->tax_deduction,
            ]
        );

        flash()->success( 'Salary Template created successfully.');

        $this->salaryModalshow = false;
    }


    public function updated()
    {
        // Optional: validate or sanitize
        $this->basic_salary = $this->basicSalary;
        $this->house_rent= $this->houseRentAmount ? $this->houseRentAmount: round($this->basicSalary/100 * $this->houseRentPercent);
        $this->medical_allowance= $this->medicalAllowanceAmount ? $this->medicalAllowanceAmount: round($this->basicSalary/100 * $this->medicalAllowancePercent);
        $this->dear_allowance=$this->dearAllowanceAmout ? $this->dearAllowanceAmout: round($this->basicSalary/100 * $this->dearAllowanceAmout);
        $this->transport_allowance=$this->transportAllowanceAmount ? $this->transportAllowanceAmount: round($this->basicSalary/100 * $this->transportAllowancePercent);
        $this->pf_employer_contribution=$this->pfEployerContributionAmount ? $this->pfEployerContributionAmount: round($this->basicSalary/100 * $this->pfEployerContributionPercent);
        $this->other_allowance=$this->otherAllowanceAmount ? $this->otherAllowanceAmount: round($this->basicSalary/100 * $this->otherAllowancePercent);
        $this->pf_employee_contribution=$this->pfEmployeeContributionAmount ? $this->pfEmployeeContributionAmount: round($this->basicSalary/100 * $this->pfEmployeeContributionPercent);
        $this->welfare_contribution=$this->welfareContributionAmount ? $this->welfareContributionAmount: round($this->basicSalary/100 * $this->welfareContributionPercnet);
        $this->tax_deduction=$this->taxDeductionAmount ? $this->taxDeductionAmount: round($this->basicSalary/100 * $this->taxDeductionPercent);
        $this->totalSalary = $this->basicSalary+$this->house_rent+$this->medical_allowance+ $this->dear_allowance+ $this->transport_allowance+$this->pf_employer_contribution+$this->other_allowance - $this->pf_employee_contribution - $this->welfare_contribution -$this->tax_deduction;

    }

      public function closeModal()
    {
        $this->salaryModalshow = false;
        $this->resetErrorBag();
    }


    public function toggleStatus($designationId)
    {
        $designation         = Designation::findOrFail($designationId);
        $designation->status = $designation->status === 'active' ? 'inactive' : 'active';
        $designation->save();

        flash()->success('Designation status updated successfully.');
    }

    public function deleteDesignation($designationId)
    {
        $designation = Designation::findOrFail($designationId);
        $designation->delete();

        flash()->success('Designation deleted successfully.');
    }

    public function render()
    {
        $designations = Designation::latest()->paginate(10);
        return view('livewire.admin.designation.designation-management', compact('designations'));
    }
}
