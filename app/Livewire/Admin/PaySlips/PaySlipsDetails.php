<?php

namespace App\Livewire\Admin\PaySlips;

use App\Models\Payroll;
use Livewire\Component;

class PaySlipsDetails extends Component
{
    public $paySlip;

    public function mount($payslip)
    {
        $this->paySlip =Payroll::findOrFail($payslip)->load('employee', 'employee.salaryData');
    }
    public function render()
    {
        return view('livewire.admin.pay-slips.pay-slips-details');
    }
}
