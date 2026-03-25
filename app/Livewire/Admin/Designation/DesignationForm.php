<?php
namespace App\Livewire\Admin\Designation;

use App\Http\Requests\DesignationRequest;
use App\Models\BranchGroup;
use App\Models\Department;
use App\Models\Designation;
use Livewire\Component;

class DesignationForm extends Component
{
    public $designation;
    public $isEditMode            = false;
    public $department_id_options = [];
    public $department_id_search;
    public $name;
    public $department_id;
    public $description;
    public $status = 'active';

    public $group;
    public $group_options = [];
    public $group_search;

    public function mount($designation = null)
    {
        $this->loadDepartmentIdOptions();
        if (!$designation) {
            $this->loadGroups();
        }
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
            )->when($this->group, fn($q) =>
                $q->whereHas('branch', fn($q) =>
                    $q->where('branch_group_id', $this->group)
                )
            )
            ->limit($this->group ? 1000 : 5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedDepartmentIdSearch()
    {
        $this->loadDepartmentIdOptions();
    }

    public function loadGroups()
    {
        $this->group_options = BranchGroup::query()
            ->when($this->group_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->group_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedGroupSearch(): void
    {
        $this->loadGroups();
    }

     public function updatedGroup(): void
    {
        $this->loadDepartmentIdOptions();
        if ($this->isEditMode) {
            $this->department_id = array_key_first($this->department_id_options) ?? null;
        } else {
            // Select all departments in this group by default
            $this->department_id = array_keys($this->department_id_options);
        }
    }

    public function save()
    {
        $baseRules    = (new DesignationRequest())->rules();
        $baseMessages = (new DesignationRequest())->messages();

        if ($this->isEditMode) {
            $data = $this->validate(
                array_merge($baseRules, ['department_id' => 'required|exists:departments,id']),
                $baseMessages
            );

            $this->designation->update($data);
        } else {
            $data = $this->validate(
                array_merge($baseRules, [
                    'department_id'   => 'required|array|min:1',
                    'department_id.*' => 'exists:departments,id',
                ]),
                array_merge($baseMessages, [
                    'department_id.required' => 'Please select at least one department.',
                    'department_id.array'    => 'Department must be a valid selection.',
                    'department_id.*.exists' => 'One or more selected departments are invalid.',
                ])
            );

            $departmentIds = is_array($this->department_id) ? $this->department_id : [$this->department_id];

            foreach ($departmentIds as $departmentId) {
                Designation::create([
                    'name'          => $data['name'],
                    'department_id' => $departmentId,
                    'description'   => $data['description'] ?? null,
                    'status'        => $data['status'],
                ]);
            }
        }

        flash()->success('Designation saved successfully.');
        return redirect()->route('admin.designations.index');
    }
    public function render()
    {
        return view('livewire.admin.designation.designation-form');
    }
}
