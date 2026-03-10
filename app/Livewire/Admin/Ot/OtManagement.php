<?php

namespace App\Livewire\Admin\Ot;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class OtManagement extends Component
{
    use WithPagination;
    public $branch;
    public $branch_options = [];
    public $branch_search;
    public $departments        = [];
    public $departments_options = [];
    public $departments_search;
    public $search;
    public $selectedEmployees = [];

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
            ->prepend('Select Branch','')
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

 

    // public function exportEmployees()
    // {
    //     if (empty($this->selectedEmployees)) {
    //         flash()->error('Please select at least one employee to export.');
    //         return;
    //     }
    // }

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
        return view('livewire.admin.ot.ot-management', [
            'ots' => $query->paginate(10),
        ]);
    }
}
