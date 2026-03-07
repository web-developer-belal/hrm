<?php
namespace App\Livewire\Admin\Department;

use App\Http\Requests\DepartmentRequest;
use App\Models\Branch;
use App\Models\Department;
use Livewire\Component;

class DepartmentForm extends Component
{
    public $isEditMode = false;
    public $name;
    public $branch;
    public $description;
    public $status         = 'active';
    public $branch_options = [];
    public $branch_search;

    public $department;

    public function mount($department = null)
    {
        $this->branch = $this->loadBranches();

        if ($department) {
            $this->isEditMode  = true;
            $this->department  = Department::findOrFail($department);
            $this->name        = $this->department->name;
            $this->branch      = $this->department->branch_id;
            $this->description = $this->department->description;
            $this->status      = $this->department->status;
        }
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
            ->toArray();
    }
    public function updatedBranchSearch(): void
    {
        $this->loadBranches();
    }

    
    public function save()
    {
        $validatedData = $this->validate((new DepartmentRequest())->rules(), (new DepartmentRequest())->messages());

        $validatedData['branch_id'] = $this->branch;
        if ($this->isEditMode) {
            $this->department->update($validatedData);
            flash()->success('Department updated successfully.');
        } else {
            Department::create($validatedData);
            flash()->success('Department created successfully.');
        }

        return redirect()->route('admin.departments.index');
    }

    public function render()
    {
        return view('livewire.admin.department.department-form');
    }
}
