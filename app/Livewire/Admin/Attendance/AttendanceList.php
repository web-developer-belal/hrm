<?php

namespace App\Livewire\Admin\Attendance;
use Livewire\WithPagination;
use App\Models\Attendance;
use Livewire\Component;

class AttendanceList extends Component
{
    use WithPagination;

    public function render()
    {
        
        $query = Attendance::query();

            $query->where('date',today());
        return view('livewire.admin.attendance.attendance-list',[
            'attendancelist'=> $query->paginate(10),
        ]);
    }
}
 