<?php
namespace App\Livewire\Employ\Loan;

use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LoanManagement extends Component
{
    use WithPagination;
    public $employee;
    public function mount()
    {
        $this->employee = Auth::guard('employee')->user();
    }
    public function render()
    {
        $query = Loan::with('employee','branch')->where('employee_id', $this->employee->id);
        return view('livewire.employ.loan.loan-management', [
            'loans' => $query->paginate(10),
        ]);
    }
}
