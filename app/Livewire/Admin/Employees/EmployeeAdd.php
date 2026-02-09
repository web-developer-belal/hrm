<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Branch;
use Livewire\Component;
use App\Models\Department;
use App\Models\Designation;
use Livewire\WithFileUploads;
use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;

class EmployeeAdd extends Component
{
    use WithFileUploads;
    public $isEditMode = false;
    public $branches = [];
    public $departments = [];
    public $designations = [];
    public $emp;
    public $employee_id;
    public $existingPhoto;
    public $photo;
    public $first_name;
    public $last_name;
    public $date_of_birth;
    public $gender;
    public $contact_number;
    public $alternative_phone_number;
    public $local_address;
    public $permanent_address;
    public $description;
    public $employee_code;
    public $branch_id;
    public $department_id;
    public $designation_id;
    public $shift_id;
    public $joining_date;
    public $workspace;
    public $supervisor_id;
    public $bank_name;
    public $routing_number;
    public $account_holder_name;
    public $bank_account_type;
    public $account_number;
    public $bank_notes;
    public $status;

    public function mount($emp = null)
    {
        $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', '')->toArray();
        $this->departments = Department::where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();
        $this->designations = Designation::where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();

        if ($emp) {

            $this->isEditMode = true;

            $emp = Employee::findorfail($emp);
            $this->emp = $emp;
            $this->employee_id= $emp->id;
            $this->first_name = $emp->first_name;
            $this->last_name = $emp->last_name;
            $this->date_of_birth = $emp->date_of_birth;
            $this->gender = $emp->gender;
            $this->contact_number = $emp->contact_number;
            $this->alternative_phone_number = $emp->alternative_phone_number;
            $this->local_address = $emp->local_address;
            $this->permanent_address = $emp->permanent_address;
            $this->description = $emp->description;
            $this->employee_code = $emp->employee_code;
            $this->branch_id = $emp->branch_id;
            $this->department_id = $emp->department_id;
            $this->designation_id = $emp->designation_id;
            $this->shift_id = $emp->shift_id;
            $this->joining_date = $emp->joining_date;
            $this->workspace = $emp->workspace;
            $this->supervisor_id = $emp->supervisor_id;
            $this->bank_name = $emp->bank_name;
            $this->routing_number = $emp->routing_number;
            $this->account_holder_name = $emp->account_holder_name;
            $this->bank_account_type = $emp->bank_account_type;
            $this->account_number = $emp->account_number;
            $this->bank_notes = $emp->bank_notes;
            $this->status = $emp->status;
        }
    }

    public function saveEmployee()
    {
        $data = $this->validate(new StoreEmployeeRequest()->rules(), new StoreEmployeeRequest()->messages());

        if( $this->isEditMode = true)
        {
            $emp = Employee::findorfail($this->employee_id);

            $emp->update($data);
        }else{
            Employee::create($data);
        }


        flash()->success($this->isEditMode ? 'Employee updated successfully.' : 'Employee created successfully.');
        return redirect()->route('admin.employees.index');
    }

    public function render()
    {
        return view('livewire.admin.employees.employee-add');
    }
}
