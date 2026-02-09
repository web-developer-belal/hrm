<?php

namespace App\Livewire\Admin\Employees;

use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use App\Models\Employee;
use Livewire\Component;

class EmployeeList extends Component
{
    use WithPagination;


    public function statusToggle($id)
    {
        $statusChange = Employee::findorfail($id);
        $currentStatus = $statusChange->status;
        $statusChange->update([
        'status' => $currentStatus == 0 ? 1 : 0
        ]);
        flash()->success('Employee Status Change successfully.');
    }
    public function render()
    {
        $query = Employee::query();
        $query->with(['branch','department','designation']);
        return view('livewire.admin.employees.employee-list',[
            'employees'=> $query->paginate(10),
        ]);
    }
}
