<?php
namespace App\Livewire\Admin\PayrollAdjustment;

use App\Models\Branch;
use App\Models\PayrollAdjustment;
use Livewire\Component;
use Livewire\WithPagination;

class AdjustmentAdditionDeduction extends Component
{
    use WithPagination;

    public $search;
    public $branches = [];
    public $branches_options = [];
    public $branches_search;

    public function mount()
    {
        $this->loadBranches();
    }
    public function updatedBranchesSearch()
    {
        $this->loadBranches();
    }
    public function loadBranches()
    {
        $this->branches_options = Branch::when($this->branches_search, function ($query) {
            $query->where('name', 'like', '%' . $this->branches_search . '%');
        })->where('status', 'active')->take(5)->pluck('name', 'id')->toArray();
    }

    public function render()
    {
        $query = PayrollAdjustment::with('branch', 'employee')->when($this->search, function ($query) {
            $query->whereHas('employee', function ($q) {
                $q->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%');
            });
        })->when($this->branches, function ($query) {
            $query->whereIn('branch_id', $this->branches);
        })->latest();
        
        return view('livewire.admin.payroll-adjustment.adjustment-addition-deduction', [
            'adjustments' => $query->paginate(10),
        ]);
    }
}
