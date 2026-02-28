<?php
namespace App\Livewire\Employ\Leave;

use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LeaveManagement extends Component
{
    use WithPagination;
    public $employee;
    public function mount()
    {
        $this->employee = Auth::guard('employee')->user();
    }
    public function render()
    {
        $leaves = Leave::where('employee_id', $this->employee->id)->paginate(10);
        return view('livewire.employ.leave.leave-management', compact('leaves'));
    }

}
