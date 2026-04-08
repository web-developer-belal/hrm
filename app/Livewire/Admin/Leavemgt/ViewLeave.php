<?php

namespace App\Livewire\Admin\Leavemgt;

use App\Models\Leave;
use Livewire\Component;

class ViewLeave extends Component
{
    public $leave;

    public function mount(Leave $leave)
    {
        $this->leave = $leave->loadMissing(['branch', 'employee.department', 'type', 'approver']);
    }

    public function render()
    {
        return view('livewire.admin.leavemgt.view-leave');
    }
}
