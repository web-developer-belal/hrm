<?php
namespace App\Livewire\Admin\Notice;

use App\Models\Notice;
use Livewire\Component;
use Livewire\WithPagination;

class ManageNotice extends Component
{
    use WithPagination;

    public $search;

    public function deleteNotice($id){
        $notice=Notice::findOrFail($id);
        $notice->delete();
        flash()->success('Deleted successfully.');
    }
    public function render()
    {
        $notices = Notice::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })->latest()->paginate(10);

        return view('livewire.admin.notice.manage-notice', compact('notices'));
    }
}
