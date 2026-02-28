<?php
namespace App\Livewire\Employ\Loan;

use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewLoan extends Component
{
    public $loan;
    public $employee;

    public function mount($loan)
    {
        $this->employee = Auth::guard('employee')->user();
        $this->loan     = Loan::where('employee_id', $this->employee->id)->where('id', $loan)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.employ.loan.view-loan');
    }
}
