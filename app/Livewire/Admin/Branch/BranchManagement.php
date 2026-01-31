<?php

namespace App\Livewire\Admin\Branch;

use App\Models\Branch;
use Livewire\Component;
use Livewire\WithPagination;

class BranchManagement extends Component
{
    use WithPagination;
    public function toggleStatus(Branch $branch)
    {
        $branch->status = $branch->status === 'active' ? 'inactive' : 'active';
        $branch->save();
        // notyf()->success('Branch status updated successfully.');
    }

    public function deleteBranch(Branch $branch)
    {
        $branch->delete();
        // notyf()->success('Branch deleted successfully.');
    }

    public function render()
    {
        $branches = Branch::latest()->paginate(10);
        return view('livewire.admin.branch.branch-management', compact('branches'));
    }
}
