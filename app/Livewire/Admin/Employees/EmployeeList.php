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
    public $salaryForm = [
        'basic_salary' => null,
        'house_rent' => null,
        'medical_allowance' => null,
        'dear_allowance' => null,
        'transport_allowance' => null,
        'pf_employer_contribution' => null,
        'other_allowance' => null,
        'pf_employee_contribution' => null,
        'welfare_contribution' => null,
        'tax_deduction' => null,
    ];

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

        $this->salaryForm = [
            'basic_salary' => $salary->basic_salary ?? null,
            'house_rent' => $salary->house_rent ?? null,
            'medical_allowance' => $salary->medical_allowance ?? null,
            'dear_allowance' => $salary->dear_allowance ?? null,
            'transport_allowance' => $salary->transport_allowance ?? null,
            'pf_employer_contribution' => $salary->pf_employer_contribution ?? null,
            'other_allowance' => $salary->other_allowance ?? null,
            'pf_employee_contribution' => $salary->pf_employee_contribution ?? null,
            'welfare_contribution' => $salary->welfare_contribution ?? null,
            'tax_deduction' => $salary->tax_deduction ?? null,
        ];

        $this->resetValidation();
        $this->dispatch('open-salary-modal');
    }

    public function saveSalary(): void
    {
        $validated = $this->validate([
            'salaryEmployeeId' => ['required', 'exists:employees,id'],
            'salaryForm.basic_salary' => ['nullable', 'numeric', 'min:0'],
            'salaryForm.house_rent' => ['nullable', 'numeric', 'min:0'],
            'salaryForm.medical_allowance' => ['nullable', 'numeric', 'min:0'],
            'salaryForm.dear_allowance' => ['nullable', 'numeric', 'min:0'],
            'salaryForm.transport_allowance' => ['nullable', 'numeric', 'min:0'],
            'salaryForm.pf_employer_contribution' => ['nullable', 'numeric', 'min:0'],
            'salaryForm.other_allowance' => ['nullable', 'numeric', 'min:0'],
            'salaryForm.pf_employee_contribution' => ['nullable', 'numeric', 'min:0'],
            'salaryForm.welfare_contribution' => ['nullable', 'numeric', 'min:0'],
            'salaryForm.tax_deduction' => ['nullable', 'numeric', 'min:0'],
        ]);

        $employee = Employee::findOrFail($validated['salaryEmployeeId']);

        Salary::updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'branch_id' => $employee->branch_id,
                'employee_id' => $employee->id,
                'basic_salary' => $validated['salaryForm']['basic_salary'] ?? 0,
                'house_rent' => $validated['salaryForm']['house_rent'] ?? 0,
                'medical_allowance' => $validated['salaryForm']['medical_allowance'] ?? 0,
                'dear_allowance' => $validated['salaryForm']['dear_allowance'] ?? 0,
                'transport_allowance' => $validated['salaryForm']['transport_allowance'] ?? 0,
                'pf_employer_contribution' => $validated['salaryForm']['pf_employer_contribution'] ?? 0,
                'other_allowance' => $validated['salaryForm']['other_allowance'] ?? 0,
                'pf_employee_contribution' => $validated['salaryForm']['pf_employee_contribution'] ?? 0,
                'welfare_contribution' => $validated['salaryForm']['welfare_contribution'] ?? 0,
                'tax_deduction' => $validated['salaryForm']['tax_deduction'] ?? 0,
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
