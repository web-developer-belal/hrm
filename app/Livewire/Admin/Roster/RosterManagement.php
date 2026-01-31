<?php
namespace App\Livewire\Admin\Roster;

use App\Models\Roster;
use Livewire\Component;
use Livewire\WithPagination;

class RosterManagement extends Component
{
    use WithPagination;
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
        $rosters = Roster::with(['branch', 'department', 'shift'])->orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.roster.roster-management', compact('rosters'));
    }
}
