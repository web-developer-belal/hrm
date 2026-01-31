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
    public $branch_id;
    public $description;
    public $status;
    public $branches = [];
    public $department;

    public function mount($department = null)
    {
        $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', 0)->toArray();

        if ($department) {
            $this->isEditMode = true;
            $this->department = Department::findOrFail($department);
            $this->name = $this->department->name;
            $this->branch_id = $this->department->branch_id;
            $this->description = $this->department->description;
            $this->status = $this->department->status;
        }
    }

    public function save()
    {
        $validatedData = $this->validate((new DepartmentRequest())->rules(), (new DepartmentRequest())->messages());

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
