<?php
namespace App\Livewire\Admin\Notice;

use App\Models\Branch;
use App\Models\Notice;
use Livewire\Component;
use Livewire\WithPagination;

class ManageNotice extends Component
{
    use WithPagination;

    public $search;
    public $branches=[];

    public $branches_options=[];
    public $branches_search;

    public function mount()
    {
        $this->loadBranches();
    }

    public function updatedBranchesSearch()
    {
        $this->loadBranches();
    }

    public function loadBranches()
    {
        $this->branches_options = Branch::whereHas('notices')->when($this->branches_search, function ($query) {
            $query->where('name', 'like', '%' . $this->branches_search . '%');
        })->where('status', 'active')->take(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function deleteNotice($id){
        $notice=Notice::findOrFail($id);
        $notice->delete();
        flash()->success('Deleted successfully.');
    }
    public function render()
    {
        $notices = Notice::with('branch','department')->when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })->when($this->branches, function ($query) {
            $query->whereIn('branch_id', $this->branches);
        })->latest()->paginate(10);

        return view('livewire.admin.notice.manage-notice', compact('notices'));
    }
}
