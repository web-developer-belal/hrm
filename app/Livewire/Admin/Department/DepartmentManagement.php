<?php

namespace App\Livewire\Admin\Department;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentManagement extends Component
{
    use WithPagination;
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
            $department->status = !$department->status;
            $department->save();
            flash()->success('Department status updated successfully.');
        } else {
            flash()->error('Department not found.');
        }
    }
    public function render()
    {
        $departments = Department::paginate(10);
        return view('livewire.admin.department.department-management', compact('departments'));
    }
}
