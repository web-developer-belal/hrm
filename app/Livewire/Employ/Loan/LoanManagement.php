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
    public $startDate = null;
    public $endDate = null;

    protected $listeners = ['date-range-update' => 'updateDateRange'];

    public function mount()
    {
        $this->employee = Auth::guard('employee')->user();
        $this->startDate = null;
        $this->endDate = null;
    }

    public function updateDateRange($start, $end)
    {
        $this->startDate = $start;
        $this->endDate = $end;
        $this->resetPage(); // Reset pagination when filter changes
    }

    public function clearDateFilter()
    {
        $this->startDate = null;
        $this->endDate = null;
        $this->resetPage();
    }

    public function render()
    {
        $query = Loan::with('employee', 'branch')
            ->where('employee_id', $this->employee->id);

        // Apply date filter on start_month column if dates are provided
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('start_month', [$this->startDate, $this->endDate]);
        }

        return view('livewire.employ.loan.loan-management', [
            'loans' => $query->paginate(10),
        ]);
    }
}
