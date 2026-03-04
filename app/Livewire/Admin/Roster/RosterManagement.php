<?php
namespace App\Livewire\Admin\Roster;

use App\Models\Branch;
use App\Models\Roster;
use Livewire\Component;
use Livewire\WithPagination;

class RosterManagement extends Component
{
    use WithPagination;
    public $branches         = [];
    public $branches_options = [];
    public $branches_search;
    public $search;
    public function mount()
    {
        $this->loadBranches();
    }

    protected function loadBranches(): void
    {
        $this->branches_options = Branch::query()
            ->where('status', 'active')
            ->when($this->branches_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branches_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedBranchesSearch(): void
    {
        $this->loadBranches();
    }
    public function toggleStatus($rosterId)
    {
        $roster         = Roster::findOrFail($rosterId);
        $roster->status = $roster->status === 'active' ? 'inactive' : 'active';
        $roster->save();
        flash()->success('Roster status updated successfully.');
    }
    public function deleteRoster($rosterId)
    {
        $roster = Roster::findOrFail($rosterId);
        $roster->delete();
        flash()->success('Roster deleted successfully.');
    }
    public function render()
    {
        $rosters = Roster::with(['branch', 'department', 'shift'])
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhereHas('department', function ($deptQuery) {
                            $deptQuery->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('shift', function ($shiftQuery) {
                            $shiftQuery->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->branches, function ($q) {
                $q->whereIn('branch_id', (array) $this->branches);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.roster.roster-management', compact('rosters'));
    }
}
