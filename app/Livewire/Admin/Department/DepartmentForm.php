<?php
namespace App\Livewire\Admin\Department;

use App\Http\Requests\DepartmentRequest;
use App\Models\Branch;
use App\Models\BranchGroup;
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

    public $group;
    public $group_options = [];
    public $group_search;

    public $department;

    public function mount($department = null)
    {
        $this->loadBranches();
        $this->loadGroups();
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
            ->when($this->group, fn($q) =>
                $q->where('branch_group_id', $this->group)
            )
            ->when($this->branch_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branch_search . '%')
            )
            ->limit($this->group ? 1000 : 5)
            ->pluck('name', 'id')
            ->toArray();
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
        $this->loadBranches();
        if ($this->isEditMode) {
            $this->branch = array_key_first($this->branch_options) ?? null;
        } else {
            // Select all branches in this group by default
            $this->branch = array_keys($this->branch_options);
        }
    }

    public function updatedBranchSearch(): void
    {
        $this->loadBranches();
    }

    
    public function save()
    {
        $baseRules    = (new DepartmentRequest())->rules();
        $baseMessages = (new DepartmentRequest())->messages();

        if ($this->isEditMode) {
            $validatedData = $this->validate(
                array_merge($baseRules, ['branch' => 'required|exists:branches,id']),
                $baseMessages
            );
            $this->department->update([
                'name'        => $validatedData['name'],
                'branch_id'   => $this->branch,
                'description' => $validatedData['description'] ?? null,
                'status'      => $validatedData['status'],
            ]);
            flash()->success('Department updated successfully.');
        } else {
            $validatedData = $this->validate(
                array_merge($baseRules, [
                    'branch'   => 'required|array|min:1',
                    'branch.*' => 'exists:branches,id',
                ]),
                array_merge($baseMessages, [
                    'branch.required' => 'Please select at least one branch.',
                    'branch.array'    => 'Branch must be a valid selection.',
                    'branch.*.exists' => 'One or more selected branches are invalid.',
                ])
            );
            $branches = is_array($this->branch) ? $this->branch : [$this->branch];
            foreach ($branches as $branchId) {
                Department::create([
                    'name'        => $validatedData['name'],
                    'branch_id'   => $branchId,
                    'description' => $validatedData['description'] ?? null,
                    'status'      => $validatedData['status'],
                ]);
            }
            flash()->success('Department created successfully.');
        }

        return redirect()->route('admin.departments.index');
    }

    public function render()
    {
        return view('livewire.admin.department.department-form');
    }
}
