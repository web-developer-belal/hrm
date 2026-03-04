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
    public $transferid;

    public $selectedEmployee;
    public $employee_id;
    public $branch_id;

    public $form_branch;
    public $form_branch_id;
    public $form_department;
    public $form_department_id;

    public $to_branch_id;
    public $to_department_id;

    public $note;
    public $status=0;

    // Searchable Selects

    public $selectedEmployee_options = [];
    public $selectedEmployee_search;

    public $to_branch_id_options = [];
    public $to_branch_id_search;

    public $to_department_id_options = [];
    public $to_department_id_search;

    public function mount($transferid = null)
    {
        $this->loadSelectedEmployeeOptions();
        $this->loadToBranchIdOptions();

        if ($transferid) {
            $this->isEditMode = true;
            $this->transferid = Transfer::findOrFail($transferid);

            $this->employee_id        = $this->transferid->employee_id;
            $this->branch_id          = $this->transferid->branch_id;
            $this->selectedEmployee   = $this->transferid->employee_id;

            $this->form_branch        = $this->transferid->fromBranch->name;
            $this->form_branch_id     = $this->transferid->form_branch_id;
            $this->form_department    = $this->transferid->fromDepartment->name;
            $this->form_department_id = $this->transferid->form_department_id;

            $this->note   = $this->transferid->note;
            $this->status = $this->transferid->status;

            $this->to_branch_id     = $this->transferid->to_branch_id;
            $this->to_department_id = $this->transferid->to_department_id;

            $this->loadToDepartmentIdOptions();
        }
    }

    protected function loadSelectedEmployeeOptions()
    {
        $this->selectedEmployee_options = Employee::where('status', 'active')
            ->when($this->selectedEmployee_search, function ($query) {
                $search = '%' . $this->selectedEmployee_search . '%';

                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', $search)
                        ->orWhere('last_name', 'like', $search)
                        ->orWhere('contact_number', 'like', $search)
                        ->orWhere('employee_code', 'like', $search);
                });
            })
            ->latest()
            ->limit(5)
            ->get()
            ->mapWithKeys(fn($emp) => [
                $emp->id => $emp->full_name
            ])
            ->toArray();
    }

    public function updatedSelectedEmployeeSearch()
    {
        $this->loadSelectedEmployeeOptions();
    }

    public function updatedSelectedEmployee()
    {
        $employee = Employee::findOrFail($this->selectedEmployee);

        $this->employee_id = $employee->id;
        $this->branch_id   = $employee->branch_id;

        $this->form_branch        = $employee->branch->name;
        $this->form_branch_id     = $employee->branch_id;
        $this->form_department    = $employee->department->name;
        $this->form_department_id = $employee->department_id;
    }

    protected function loadToBranchIdOptions()
    {
        $this->to_branch_id_options = Branch::where('status', 'active')
            ->when($this->to_branch_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->to_branch_id_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedToBranchIdSearch()
    {
        $this->loadToBranchIdOptions();
    }

    public function updatedToBranchId()
    {
        $this->to_department_id = null;
        $this->to_department_id_options = [];

        $this->loadToDepartmentIdOptions();
    }

    protected function loadToDepartmentIdOptions()
    {
        if (!$this->to_branch_id) {
            $this->to_department_id_options = [];
            return;
        }

        $this->to_department_id_options = Department::where('status', 'active')
            ->where('branch_id', $this->to_branch_id)
            ->when($this->to_department_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->to_department_id_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedToDepartmentIdSearch()
    {
        $this->loadToDepartmentIdOptions();
    }

    public function submitTransfer()
    {
        $data = $this->validate(
            (new EmployeeTransferRequest())->rules(),
            (new EmployeeTransferRequest())->messages()
        );

        if ($this->isEditMode) {

            $this->transferid->update($data);

            $checkTransfer = Transfer::findOrFail($this->transferid->id);

            if ($checkTransfer->status === 1) {
                $emp = Employee::findOrFail($checkTransfer->employee_id);
                $emp->update([
                    'branch_id'     => $checkTransfer->to_branch_id,
                    'department_id' => $checkTransfer->to_department_id,
                ]);
            }

        } else {

            $transferEmp = Transfer::create($data);

            if ($transferEmp->status === 1) {
                $emp = Employee::findOrFail($transferEmp->employee_id);
                $emp->update([
                    'branch_id'     => $transferEmp->to_branch_id,
                    'department_id' => $transferEmp->to_department_id,
                ]);
            }
        }

        flash()->success(
            $this->isEditMode
                ? 'Employee Transfer updated successfully.'
                : 'Employee Transfer created successfully.'
        );

        return redirect()->route('admin.transfer.index');
    }

    public function render()
    {
        return view('livewire.admin.transfer.transfer-new');
    }
}