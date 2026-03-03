<?php
namespace App\Livewire\Admin\Designation;

use App\Http\Requests\DesignationRequest;
use App\Models\Department;
use App\Models\Designation;
use Livewire\Component;

class DesignationForm extends Component
{
    public $designation;
    public $isEditMode  = false;
    public $department_id_options = [];
    public $department_id_search;
    public $name;
    public $department_id;
    public $description;
    public $status = 'active';
    public function mount($designation = null)
    {
        $this->loadDepartmentIdOptions();

        if ($designation) {
            $this->isEditMode    = true;
            $this->designation   = Designation::findOrFail($designation);
            $this->name          = $this->designation->name;
            $this->department_id = $this->designation->department_id;
            $this->description   = $this->designation->description;
            $this->status        = $this->designation->status;
        }
    }
     protected function loadDepartmentIdOptions()
    {
        $this->department_id_options = Department::where('status', 'active')
            ->when($this->department_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->department_id_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedDepartmentIdSearch()
    {
        $this->loadDepartmentIdOptions();
    }

    public function save()
    {
        $data = $this->validate((new DesignationRequest())->rules(), (new DesignationRequest())->messages());
        if ($this->isEditMode) {
            $this->designation->update($data);
        } else {
            Designation::create($data);
        }
        flash()->success('Designation saved successfully.');
        return redirect()->route('admin.designations.index');
    }
    public function render()
    {
        return view('livewire.admin.designation.designation-form');
    }
}
