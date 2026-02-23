<?php
namespace App\Livewire\Admin\Transfer;

use App\Http\Requests\EmployeeTransferRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Transfer;
use Livewire\Component;

class TransferNew extends Component
{
    public $isEditMode = false;

    public $branches      = [];
    public $departments   = [];
    public $employeesData = [];
    public $selectedEmployee;
    public $transferid;
    public $form_branch, $form_branch_id, $form_department, $form_department_id, $to_branch_id, $to_department_id, $note, $status, $employee_id, $branch_id;

    public function mount($transferid = null)
    {
        $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', '')->toArray();

        $this->departments   = Department::where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();
        $this->employeesData = Employee::pluck('first_name', 'id')->prepend('Select Employee', '')->toArray();

        if ($transferid) {
            $this->isEditMode = true;
            $this->transferid = Transfer::findOrFail($transferid);

            $this->employee_id        = $this->transferid->employee_id;
            $this->branch_id          = $this->transferid->branch_id;
            $this->selectedEmployee   = $this->transferid->employee_id;
            $this->form_branch        = $this->transferid->frombranch->name;
            $this->form_branch_id     = $this->transferid->form_branch_id;
            $this->form_department    = $this->transferid->formdepartment->name;
            $this->form_department_id = $this->transferid->form_department_id;
            $this->note               = $this->transferid->note;
            $this->status             = $this->transferid->status;

            $this->to_branch_id     = $this->transferid->to_branch_id;
            $this->to_department_id = $this->transferid->to_department_id;

        }
    }

    public function updatedSelectedEmployee()
    {
        $this->selectedEmployee = Employee::findorfail($this->selectedEmployee);

        $this->employee_id = $this->selectedEmployee->id;
        $this->branch_id   = $this->selectedEmployee->branch_id;

        $this->form_branch        = $this->selectedEmployee->branch->name;
        $this->form_branch_id     = $this->selectedEmployee->branch_id;
        $this->form_department    = $this->selectedEmployee->department->name;
        $this->form_department_id = $this->selectedEmployee->department_id;

        $this->selectedEmployee = $this->selectedEmployee->id;
    }

    public function submitTransfer()
    {
        $data = $this->validate((new EmployeeTransferRequest())->rules(), (new EmployeeTransferRequest())->messages());
        if ($this->isEditMode) {

            $this->transferid->update($data);

            $checkTransfer = Transfer::findorfail($this->transferid->id);

            if ($checkTransfer->status === 1) {
                $emp = Employee::findorfail($checkTransfer->employee_id);
                $emp->update([
                    'branch_id'     => $checkTransfer->to_branch_id,
                    'department_id' => $checkTransfer->to_department_id,
                ]);

            }

        } else {

            $transferEmp = Transfer::create($data);

            if ($transferEmp->status === 1) {
                $emp = Employee::findorfail($transferEmp->employee_id);
                $emp->update([
                    'branch_id'     => $transferEmp->to_branch_id,
                    'department_id' => $transferEmp->to_department_id,

                ]);

            }
        }

        flash()->success($this->isEditMode ? 'Employee Transfer updated successfully.' : 'EmployeeTransfer created successfully.');
        return redirect()->route('admin.transfer.index');

    }

    public function render()
    {
        return view('livewire.admin.transfer.transfer-new');
    }
}
