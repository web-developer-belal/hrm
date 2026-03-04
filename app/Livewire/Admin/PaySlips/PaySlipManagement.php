<?php
namespace App\Livewire\Admin\PaySlips;

use App\Models\Branch;
use App\Models\Payroll;
use Livewire\Component;
use Livewire\WithPagination;

class PaySlipManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $branch;
    public $branch_options = [];
    public $branch_search;

    public function mount()
    {
        $this->loadBranches();
    }

    public function updatedBranchSearch()
    {
        $this->loadBranches();
    }

    public function loadBranches()
    {
        $this->branch_options = Branch::whereHas('payrolls')->when($this->branch_search, function ($query) {
            $query->where('name', 'like', '%' . $this->branch_search . '%');
        })->take(5)->pluck('name', 'id')->toArray();
    }
    public function render()
    {
        $query = Payroll::with(['employee', 'branch'])
            ->when($this->search, function ($query) {
                $query->whereHas('employee', function ($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')->orWhere('employee_id', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->branch, function ($query) {
                $query->where('branch_id', $this->branch);
            })
            ->latest();
        return view('livewire.admin.pay-slips.pay-slip-management', [
            'payslips' => $query->paginate(10),
        ]);
    }
}
