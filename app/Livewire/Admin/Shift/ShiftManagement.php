<?php
namespace App\Livewire\Admin\Shift;

use App\Models\Shift;
use function Flasher\Prime\flash;
use Livewire\Component;
use Livewire\WithPagination;

class ShiftManagement extends Component
{
    use WithPagination;
    public $search;

    public function toggleStatus($shiftId)
    {
        $shift         = Shift::findOrFail($shiftId);
        $shift->status = $shift->status === 'active' ? 'inactive' : 'active';
        $shift->save();
        flash()->success('Shift status updated successfully.');
    }

    public function deleteShift($shiftId)
    {
        $shift = Shift::findOrFail($shiftId);
        $shift->delete();
        flash()->success('Shift deleted successfully.');
    }

    public function render()
    {
        $shifts = Shift::when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        })->latest()->paginate(10);
        return view('livewire.admin.shift.shift-management', compact('shifts'));
    }
}
