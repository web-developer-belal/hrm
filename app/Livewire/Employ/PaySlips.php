<?php
namespace App\Livewire\Employ;

use App\Models\Payroll;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PaySlips extends Component
{
    use WithPagination;
    public $employee;

    public function mount()
    {
        $this->employee = Auth::guard('employee')->user();
    }
    public function render()
    {
        $payslips =$query = Payroll::with(['employee', 'branch'])->where('employee_id', $this->employee->id)->latest()->paginate(10);
        return view('livewire.employ.pay-slips', compact('payslips'));
    }
}
