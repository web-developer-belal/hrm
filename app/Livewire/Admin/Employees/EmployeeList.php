<?php
namespace App\Livewire\Admin\Employees;

use App\Exports\Employee\EmployeeList as EmployeeListExport;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Salary;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeList extends Component
{
    use WithPagination;
    public $branch;
    public $branch_options = [];
    public $branch_search;
    public $departments         = [];
    public $departments_options = [];
    public $departments_search;
    public $search;
    public $selectedEmployees = [];
    public $salaryEmployeeId;
    public $salaryEmployeeName = '';
    public $basicSalary = 0;
    public $houseRentPercent;
    public $houseRentAmount;
    public $medicalAllowancePercent;
    public $medicalAllowanceAmount;
    public $dearAllowancePercent;
    public $dearAllowanceAmout;
    public $transportAllowancePercent;
    public $transportAllowanceAmount;
    public $pfEployerContributionPercent;
    public $pfEployerContributionAmount;
    public $otherAllowancePercent;
    public $otherAllowanceAmount;
    public $pfEmployeeContributionPercent;
    public $pfEmployeeContributionAmount;
    public $welfareContributionPercnet;
    public $welfareContributionAmount;
    public $taxDeductionPercent;
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

    public function mount()
    {
        $this->loadBranches();
    }

    protected function loadBranches(): void
    {
        $this->branch_options = Branch::query()
            ->where('status', 'active')
            ->when($this->branch_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branch_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->prepend('Select Branch', '')
            ->toArray();

        $this->loadDepartments();
    }

    protected function loadDepartments(): void
    {
        if (! $this->branch) {
            $this->departments_options = [];
            return;
        }

        $this->departments_options = Department::where('branch_id', $this->branch)
            ->where('status', 'active')
            ->when($this->departments_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->departments_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedBranchSearch(): void
    {
        $this->loadBranches();
    }

    public function updatedDepartmentsSearch(): void
    {
        $this->loadDepartments();
    }
    public function updatedBranch(): void
    {
        $this->departments = [];
        $this->loadDepartments();
    }

    public function statusToggle($id)
    {
        $statusChange  = Employee::findOrFail($id);
        $currentStatus = $statusChange->status;
        $statusChange->update([
            'status' => $currentStatus == 0 ? 1 : 0,
        ]);
        flash()->success('Employee Status Change successfully.');
    }

    public function exportEmployees()
    {
        if (empty($this->selectedEmployees)) {
            flash()->error('Please select at least one employee to export.');
            return;
        }

        $fileName = 'employee-list-' . date('Y-m-d-His') . '.xlsx';
        return Excel::download(new EmployeeListExport($this->selectedEmployees), $fileName);
    }
    public function updateOt($action)
    {
        if ($action === '' || $action === null) {
            return;
        }

        if (! in_array((string) $action, ['0', '1'], true)) {
            flash()->error('Invalid OT action selected.');
            return;
        }

        if (empty($this->selectedEmployees)) {
            flash()->error('Please select at least one employee to update OT.');
            return;
        }

        Employee::whereIn('id', $this->selectedEmployees)->update(['has_ot' => (bool) $action]);
        flash()->success('OT updated successfully for selected employees.');
    }

    public function otToggle($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update(['has_ot' => ! $employee->has_ot]);
        flash()->success('Employee OT status updated successfully.');
    }

    public function openSalaryModal($employeeId): void
    {
        $employee = Employee::with('salaryData')->findOrFail($employeeId);

        $this->salaryEmployeeId = $employee->id;
        $this->salaryEmployeeName = $employee->full_name;

        $salary = $employee->salaryData;

        $this->basicSalary             = $salary->basic_salary ?? 0;
        $this->houseRentAmount         = $salary->house_rent ?? 0;
        $this->medicalAllowanceAmount  = $salary->medical_allowance ?? 0;
        $this->dearAllowanceAmout      = $salary->dear_allowance ?? 0;
        $this->transportAllowanceAmount = $salary->transport_allowance ?? 0;
        $this->pfEployerContributionAmount = $salary->pf_employer_contribution ?? 0;
        $this->otherAllowanceAmount    = $salary->other_allowance ?? 0;
        $this->pfEmployeeContributionAmount = $salary->pf_employee_contribution ?? 0;
        $this->welfareContributionAmount = $salary->welfare_contribution ?? 0;
        $this->taxDeductionAmount      = $salary->tax_deduction ?? 0;

        $this->houseRentPercent = null;
        $this->medicalAllowancePercent = null;
        $this->dearAllowancePercent = null;
        $this->transportAllowancePercent = null;
        $this->pfEployerContributionPercent = null;
        $this->otherAllowancePercent = null;
        $this->pfEmployeeContributionPercent = null;
        $this->welfareContributionPercnet = null;
        $this->taxDeductionPercent = null;

        $this->recalculateSalaryFields();

        $this->resetValidation();
        $this->dispatch('open-salary-modal');
    }

    protected function recalculateSalaryFields(): void
    {
        $basic = (float) ($this->basicSalary ?: 0);

        $this->basic_salary = $basic;
        $this->house_rent = $this->houseRentAmount !== null && $this->houseRentAmount !== ''
            ? (float) $this->houseRentAmount
            : round($basic / 100 * (float) ($this->houseRentPercent ?: 0));
        $this->medical_allowance = $this->medicalAllowanceAmount !== null && $this->medicalAllowanceAmount !== ''
            ? (float) $this->medicalAllowanceAmount
            : round($basic / 100 * (float) ($this->medicalAllowancePercent ?: 0));
        $this->dear_allowance = $this->dearAllowanceAmout !== null && $this->dearAllowanceAmout !== ''
            ? (float) $this->dearAllowanceAmout
            : round($basic / 100 * (float) ($this->dearAllowancePercent ?: 0));
        $this->transport_allowance = $this->transportAllowanceAmount !== null && $this->transportAllowanceAmount !== ''
            ? (float) $this->transportAllowanceAmount
            : round($basic / 100 * (float) ($this->transportAllowancePercent ?: 0));
        $this->pf_employer_contribution = $this->pfEployerContributionAmount !== null && $this->pfEployerContributionAmount !== ''
            ? (float) $this->pfEployerContributionAmount
            : round($basic / 100 * (float) ($this->pfEployerContributionPercent ?: 0));
        $this->other_allowance = $this->otherAllowanceAmount !== null && $this->otherAllowanceAmount !== ''
            ? (float) $this->otherAllowanceAmount
            : round($basic / 100 * (float) ($this->otherAllowancePercent ?: 0));
        $this->pf_employee_contribution = $this->pfEmployeeContributionAmount !== null && $this->pfEmployeeContributionAmount !== ''
            ? (float) $this->pfEmployeeContributionAmount
            : round($basic / 100 * (float) ($this->pfEmployeeContributionPercent ?: 0));
        $this->welfare_contribution = $this->welfareContributionAmount !== null && $this->welfareContributionAmount !== ''
            ? (float) $this->welfareContributionAmount
            : round($basic / 100 * (float) ($this->welfareContributionPercnet ?: 0));
        $this->tax_deduction = $this->taxDeductionAmount !== null && $this->taxDeductionAmount !== ''
            ? (float) $this->taxDeductionAmount
            : round($basic / 100 * (float) ($this->taxDeductionPercent ?: 0));

        $this->totalSalary = $this->basic_salary
            + $this->house_rent
            + $this->medical_allowance
            + $this->dear_allowance
            + $this->transport_allowance
            + $this->pf_employer_contribution
            + $this->other_allowance
            - $this->pf_employee_contribution
            - $this->welfare_contribution
            - $this->tax_deduction;
    }

    public function updated($name): void
    {
        if (
            $name === 'basicSalary'
            || str_starts_with($name, 'houseRent')
            || str_starts_with($name, 'medicalAllowance')
            || str_starts_with($name, 'dearAllowance')
            || str_starts_with($name, 'transportAllowance')
            || str_starts_with($name, 'pfEployerContribution')
            || str_starts_with($name, 'otherAllowance')
            || str_starts_with($name, 'pfEmployeeContribution')
            || str_starts_with($name, 'welfareContribution')
            || str_starts_with($name, 'taxDeduction')
        ) {
            $this->recalculateSalaryFields();
        }
    }

    public function closeSalaryModal(): void
    {
        $this->dispatch('close-salary-modal');
    }

    public function saveSalary(): void
    {
        $validated = $this->validate([
            'salaryEmployeeId' => ['required', 'exists:employees,id'],
            'basicSalary' => ['required', 'numeric', 'min:0'],
            'houseRentPercent' => ['nullable', 'numeric', 'min:0'],
            'houseRentAmount' => ['nullable', 'numeric', 'min:0'],
            'medicalAllowancePercent' => ['nullable', 'numeric', 'min:0'],
            'medicalAllowanceAmount' => ['nullable', 'numeric', 'min:0'],
            'dearAllowancePercent' => ['nullable', 'numeric', 'min:0'],
            'dearAllowanceAmout' => ['nullable', 'numeric', 'min:0'],
            'transportAllowancePercent' => ['nullable', 'numeric', 'min:0'],
            'transportAllowanceAmount' => ['nullable', 'numeric', 'min:0'],
            'pfEployerContributionPercent' => ['nullable', 'numeric', 'min:0'],
            'pfEployerContributionAmount' => ['nullable', 'numeric', 'min:0'],
            'otherAllowancePercent' => ['nullable', 'numeric', 'min:0'],
            'otherAllowanceAmount' => ['nullable', 'numeric', 'min:0'],
            'pfEmployeeContributionPercent' => ['nullable', 'numeric', 'min:0'],
            'pfEmployeeContributionAmount' => ['nullable', 'numeric', 'min:0'],
            'welfareContributionPercnet' => ['nullable', 'numeric', 'min:0'],
            'welfareContributionAmount' => ['nullable', 'numeric', 'min:0'],
            'taxDeductionPercent' => ['nullable', 'numeric', 'min:0'],
            'taxDeductionAmount' => ['nullable', 'numeric', 'min:0'],
        ]);

        $employee = Employee::findOrFail($validated['salaryEmployeeId']);

        Salary::updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'branch_id' => $employee->branch_id,
                'employee_id' => $employee->id,
                'basic_salary' => $this->basic_salary,
                'house_rent' => $this->house_rent,
                'medical_allowance' => $this->medical_allowance,
                'dear_allowance' => $this->dear_allowance,
                'transport_allowance' => $this->transport_allowance,
                'pf_employer_contribution' => $this->pf_employer_contribution,
                'other_allowance' => $this->other_allowance,
                'pf_employee_contribution' => $this->pf_employee_contribution,
                'welfare_contribution' => $this->welfare_contribution,
                'tax_deduction' => $this->tax_deduction,
            ]
        );

        flash()->success('Salary setup saved successfully.');
        $this->dispatch('close-salary-modal');
    }

    public function render()
    {
        $query = Employee::with(['branch', 'department', 'designation'])
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')
                        ->orWhere('contact_number', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('employee_code', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->branch, function ($q) {
                $q->where('branch_id', $this->branch);
            })
            ->when($this->departments, function ($q) {
                $q->whereIn('department_id', (array) $this->departments);
            });

        return view('livewire.admin.employees.employee-list', [
            'employees' => $query->latest()->paginate(10),
        ]);
    }
}
