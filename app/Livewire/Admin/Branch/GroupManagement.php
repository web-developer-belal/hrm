<?php
namespace App\Livewire\Admin\Branch;

use App\Models\Branch;
use App\Models\BranchGroup;
use Livewire\Component;

class GroupManagement extends Component
{
    public $branches = [];
    public $name;

    public $isEditMode = false;
    public $group;

    public $branches_options = [];
    public $branches_search  = '';

    public function mount()
    {
        $this->loadBranches();
    }
    private function loadBranches()
    {
        $this->branches_options = Branch::whereDoesntHave('branchGroup')
            ->where('name', 'like', '%' . $this->branches_search . '%')
            ->orderBy('name')
            ->take(6)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->branches = [];
        $this->isEditMode = false;
        $this->group = null;
    }   

    public function updatedBranchesSearch()
    {
        $this->loadBranches();
    }

    public function editGroup($id)
    {
        $this->resetForm();
        $this->isEditMode = true;
        $this->group      = BranchGroup::with('branches')->findOrFail($id);
        $this->name       = $this->group->name;
        $this->branches   = $this->group->branches->pluck('id','name')->toArray();
    }

    public function deleteGroup($id)
    {
        $group = BranchGroup::findOrFail($id);
        // Detach branches from the group
        Branch::where('branch_group_id', $group->id)->update(['branch_group_id' => null]);
        $group->delete();
        flash()->success('Group deleted successfully!');
    }

    public function saveGroup()
    {
        $this->validate([
            'name'       => 'required|string|max:255',
            'branches'   => 'nullable|array|min:1',
            'branches.*' => 'exists:branches,id',
        ]);

        if ($this->isEditMode) {
            $group = BranchGroup::findOrFail($this->group->id);
            $group->update([
                'name' => $this->name,
            ]);
        } else {
            $group = BranchGroup::create([
                'name' => $this->name,
            ]);
        }
        if (! $this->isEditMode) {
            // Attach selected branches to the group
            Branch::whereIn('id', $this->branches)->update(['branch_group_id' => $group->id]);
        }else {
            // Detach previously attached branches
            Branch::where('branch_group_id', $group->id)->update(['branch_group_id' => null]);
            // Attach newly selected branches
            Branch::whereIn('id', $this->branches)->update(['branch_group_id' => $group->id]);
        }

        flash()->success($this->isEditMode ? 'Group updated successfully!' : 'Group created successfully!');

        $this->resetForm();
        $this->loadBranches();
        $this->dispatch('close-modal');
    }

    public function render()
    {
        $groups = BranchGroup::with('branches')->latest()->paginate(10);
        return view('livewire.admin.branch.group-management', compact('groups'));
    }
}
