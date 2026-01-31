<?php

namespace App\Livewire\Admin\Shift;

use App\Models\Shift;
use Livewire\Component;
use Livewire\WithPagination;

use function Flasher\Prime\flash;

class ShiftManagement extends Component
{
    use WithPagination;

    public function toggleStatus($shiftId)
    {
        $shift = Shift::findOrFail($shiftId);
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
        $shifts =Shift::paginate(10);
        return view('livewire.admin.shift.shift-management', compact('shifts'));
    }
}
