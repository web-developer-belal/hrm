<?php

namespace App\Livewire\Admin\Loan;

use App\Models\Employee;
use App\Models\Loan;
use App\Models\LoanInstallment;
use Livewire\Component;

class LoanDetails extends Component
{
    public $employee;
    public $loan;
    public $installments=[];

    public function mount($loan)
    {
        $this->loan = Loan::findorfail($loan);

        // dd( $this->loan);
        $this->employee = Employee::findorfail($this->loan->employee_id);
        $this->installments = LoanInstallment::where('loan_id',$loan)->get();
    }

    public function render()
    {
        return view('livewire.admin.loan.loan-details');
    }
}
