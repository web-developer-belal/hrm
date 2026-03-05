<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Attendance;
use Livewire\Component;
use Livewire\WithPagination;

class AttendanceReport extends Component
{
    use WithPagination;

    public function render()
    {
        $attendanceRecords = Attendance::with('employee')->whereNotNull('status')->where('date', '>=', now()->subMonth())->orderBy('date', 'desc')
            ->paginate(10);
        return view('livewire.admin.reports.attendance-report', [
            'attendanceRecords' => $attendanceRecords,
        ]);
    }
}
