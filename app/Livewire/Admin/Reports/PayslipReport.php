<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Payroll;
use Livewire\Component;
use Livewire\WithPagination;

class PayslipReport extends Component
{
    use WithPagination;
    public function render()
    {
        $payslips = Payroll::with('employee')->latest()->paginate(10);
        return view('livewire.admin.reports.payslip-report', ['payslips' => $payslips]);
    }
}
