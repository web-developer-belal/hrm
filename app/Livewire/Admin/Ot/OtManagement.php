<?php

namespace App\Livewire\Admin\Ot;

use App\Models\BranchGroup;
use App\Models\Ot;
use Livewire\Component;
use Livewire\WithPagination;

class OtManagement extends Component
{
    use WithPagination;
    
    public $search = '';
    public $branch_group_id = '';
    public $rate_type = '';
    public $status = '';
    public $branch_group_options = [];
    public $selectedOts = [];

    public function mount()
    {
        $this->loadBranchGroupOptions();
    }

    protected function loadBranchGroupOptions(): void
    {
        $this->branch_group_options = BranchGroup::pluck('name', 'id')->toArray();
    }

    public function statusToggle($otId): void
    {
        $ot = Ot::findOrFail($otId);
        $ot->update(['status' => !$ot->status]);
        session()->flash('success', 'Status updated successfully.');
    }

    public function deleteOt($otId): void
    {
        Ot::findOrFail($otId)->delete();
        session()->flash('success', 'OT deleted successfully.');
    }

    public function render()
    {
        $query = Ot::with(['group'])
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->branch_group_id, function ($q) {
                $q->where('branch_group_id', $this->branch_group_id);
            })
            ->when($this->rate_type, function ($q) {
                $q->where('rate_type', $this->rate_type);
            })
            ->when($this->status !== '', function ($q) {
                $q->where('status', (bool)$this->status);
            });

        return view('livewire.admin.ot.ot-management', [
            'ots' => $query->paginate(15),
        ]);
    }
}
