<?php

namespace App\Livewire\Admin\Complain;

use App\Models\Branch;
use App\Models\Complain;
use App\Models\Department;
use App\Models\Employee;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class ComplainAdd extends Component
{
    use WithFileUploads;
    public $isEditMode = false;
    public $branches = [];
    public $departments = [];
    public $employeesData = [];

    #[Validate('required')]
    public $branch_id;
    #[Validate('required')]
    public $employee_id;
    #[Validate('required')]
    public $against_employee_id;
    #[Validate('required')]
    public $subject;
    #[Validate('required')]
    public $date;
    #[Validate('nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048')]
    public $document;
    #[Validate('nullable|string')]
    public $description;
    #[Validate('required')]
    public $status;

    public $remarks;
    public $complainId;
    public $oldDocument;




    public function mount($complainId = null)
    {
        $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', '')->toArray();

        $this->departments = Department::where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();
        $this->employeesData = Employee::pluck('first_name', 'id')->prepend('Select Employee', '')->toArray();

        if ($complainId) {
            $this->isEditMode = true;
            $this->complainId = Complain::findOrFail($complainId);
            $this->branch_id = $this->complainId->branch_id;
            $this->employee_id = $this->complainId->employee_id;
            $this->against_employee_id = $this->complainId->against_employee_id;
            $this->subject = $this->complainId->subject;
            $this->date = $this->complainId->date;
            $this->description = $this->complainId->description;
            $this->status = $this->complainId->status;
            $this->remarks = $this->complainId->remarks;
            $this->oldDocument = $this->complainId->document;

        }
    }

    public function submitComplain()
    {
        $this->validate();

        if ($this->isEditMode) {
            $complain = Complain::findOrFail($this->complainId->id);
            $complain->update($this->validate());
            if($this->document){
                $this->handleFileUploads($complain);
            }
        }else{
           $complain=Complain::Create($this->validate());
           $this->handleFileUploads($complain);
        }




        flash()->success($this->isEditMode ? 'Employee Complain updated successfully.' : 'Employee Complain created successfully.');
        return redirect()->route('admin.complain.index');
    }


    public function render()
    {
        return view('livewire.admin.complain.complain-add');
    }


    private function handleFileUploads(Complain $complain)
    {
        $fileUpdates = [];

        // Handle photo
        if ($this->document) {
            if ($this->isEditMode && $complain->document) {
                deleteImage($complain->document);
            }
            $fileUpdates['document'] = storeImage($this->document, 'employees/complain', 300, 300, 'webp');
        }


        if (!empty($fileUpdates)) {
            $complain->update($fileUpdates);
        }
    }
}
