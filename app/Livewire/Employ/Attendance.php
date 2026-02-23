<?php

namespace App\Livewire\Employ;

use App\Models\Attendance as ModelsAttendance;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Attendance extends Component
{

    use WithPagination;
    public $employee;

    public function mount(){
        $this->employee =Auth::guard('employee')->user();
    }

    public function render()
    {
        $attendances=ModelsAttendance::where('employee_id',$this->employee->id)->latest()->paginate(10);
        return view('livewire.employ.attendance',compact('attendances'));
    }
}
