<?php

namespace App\Livewire\Employ;

use App\Models\Payroll;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PayslipDetails extends Component
{
     public $paySlip;

    public function mount($payslip)
    {
        $this->paySlip =Payroll::where('employee_id', Auth::guard('employee')->id())->where('id', $payslip)->firstOrFail()->load('employee', 'employee.salaryData');
    }
    public function render()
    {
        return view('livewire.employ.payslip-details');
    }
}
