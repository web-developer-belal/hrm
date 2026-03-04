<?php
namespace App\Livewire\Admin\Branch;

use App\Models\Branch;
use Livewire\Component;
use Livewire\WithPagination;

class BranchManagement extends Component
{
    use WithPagination;
    public $search;
    public function toggleStatus(Branch $branch)
    {
        $branch->status = $branch->status === 'active' ? 'inactive' : 'active';
        $branch->save();
        flash()->success('Branch status updated successfully.');
    }

    public function deleteBranch(Branch $branch)
    {
        $branch->delete();
        flash()->success('Branch deleted successfully.');
    }

    public function render()
    {
        $branches = Branch::
            when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('address', 'like', '%' . $this->search . '%');
        })->
            latest()->paginate(10);
        return view('livewire.admin.branch.branch-management', compact('branches'));
    }
}
