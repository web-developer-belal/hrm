<?php
namespace App\Livewire\Admin\Department;

use App\Models\Branch;
use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentManagement extends Component
{
    use WithPagination;
    
    public $search;
    public $branches         = [];
    public $branches_options = [];
    public $branches_search;
    
    public function mount()
    {
        $this->loadBranches();
    }

    protected function loadBranches(): void
    {
        $this->branches_options = Branch::query()
            ->where('status', 'active')
            ->when($this->branches_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branches_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }
    public function updatedBranchesSearch(): void
    {
        $this->loadBranches();
    }
    public function deleteDepartment($departmentId)
    {
        $department = Department::find($departmentId);
        if ($department) {
            $department->delete();
            flash()->success('Department deleted successfully.');
        } else {
            flash()->error('Department not found.');
        }
    }
    public function toggleStatus($departmentId)
    {
        $department = Department::find($departmentId);
        if ($department) {
            $department->status = ! $department->status;
            $department->save();
            flash()->success('Department status updated successfully.');
        } else {
            flash()->error('Department not found.');
        }
    }
    public function render()
    {
        $departments = Department::when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('address', 'like', '%' . $this->search . '%');
        })->when($this->branches, function ($q) {
            $q->whereIn('branch_id', (array) $this->branches);
        })->latest()->paginate(10);
        
        return view('livewire.admin.department.department-management', compact('departments'));
    }
}
