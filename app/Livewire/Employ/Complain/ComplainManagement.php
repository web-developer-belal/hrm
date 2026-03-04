<?php
namespace App\Livewire\Employ\Complain;

use App\Models\Complain;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ComplainManagement extends Component
{
    use WithPagination;

    public $employee;
    public $startDate = null;
    public $endDate = null;

    protected $listeners = ['date-range-update' => 'updateDateRange'];

    public function mount()
    {
        $this->employee = Auth::guard('employee')->user();

        // Set dates to null for "All" (no filter)
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
        $query = Complain::with(['complainant', 'againstEmp', 'branch'])
            ->where('employee_id', $this->employee->id);

        // Apply date filter only if both dates are provided (not null)
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('date', [$this->startDate, $this->endDate]);
        }

        return view('livewire.employ.complain.complain-management', [
            'complains' => $query->paginate(10),
        ]);
    }
}
