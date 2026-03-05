<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Leave;
use Livewire\Component;
use Livewire\WithPagination;

class LeaveReport extends Component
{
    use WithPagination;
    public function render()
    {
        $leaves=Leave::with('employee')->latest()->paginate(10);
        return view('livewire.admin.reports.leave-report', ['leaves' => $leaves]);
    }
}
