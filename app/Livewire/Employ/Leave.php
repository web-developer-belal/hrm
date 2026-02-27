<?php

namespace App\Livewire\Employ;

use App\Models\Leave as ModelsLeave;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Leave extends Component
{
    public $employee;
    public function mount(){
        $this->employee=Auth::guard('employee')->user();
    }
    public function render()
    {
        $leaves=ModelsLeave::where('employee_id',$this->employee->id)->paginate(10);
        return view('livewire.employ.leave',compact('leaves'));
    }
}
