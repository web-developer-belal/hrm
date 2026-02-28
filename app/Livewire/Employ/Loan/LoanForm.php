<?php

namespace App\Livewire\Employ\Loan;

use App\Models\Loan;
use App\Models\LoanInstallment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class LoanForm extends Component
{
    public $employee;

    // Form fields
    public $amount;
    public $installment = 1;
    public $emiAmount;
    public $startMonth;
    public $note;

    public function mount()
    {
        $this->employee = Auth::guard('employee')->user();
    }

    // Recalculate EMI whenever amount or installment changes
    public function updatedAmount()
    {
        $this->calculateEmi();
    }

    public function updatedInstallment()
    {
        $this->calculateEmi();
    }

    protected function calculateEmi()
    {
        if ($this->amount && $this->installment > 0) {
            $this->emiAmount = round($this->amount / $this->installment, 2);
        } else {
            $this->emiAmount = 0;
        }
    }

    public function saveLoan()
    {
        $this->validate([
            'amount'      => 'required|numeric|min:1',
            'installment' => 'required|numeric|min:1',
            'emiAmount'   => 'required|numeric|min:0',
            'startMonth'  => 'required|date',
            'note'        => 'nullable|string',
        ]);

        // Create the loan for the authenticated employee
        $loan = Loan::create([
            'branch_id'        => $this->employee->branch_id,
            'employee_id'      => $this->employee->id,
            'amount'           => $this->amount,
            'installments'     => $this->installment,
            'emi_amount'       => $this->emiAmount,
            'remaining_amount' => $this->amount,
            'start_month'      => $this->startMonth,
            'note'             => $this->note,
        ]);

        // Create the EMI schedule
        $start = Carbon::parse($this->startMonth);

        for ($i = 0; $i < $this->installment; $i++) {
            LoanInstallment::create([
                'loan_id' => $loan->id,
                'year'    => $start->copy()->addMonths($i)->year,
                'month'   => $start->copy()->addMonths($i)->month,
                'amount'  => $this->emiAmount,
            ]);
        }

        flash()->success('Loan created successfully.');
        return redirect()->route('employee.loan');
    }

    public function render()
    {
        return view('livewire.employ.loan.loan-form');
    }
}
