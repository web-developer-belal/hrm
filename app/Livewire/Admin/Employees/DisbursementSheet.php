<?php
namespace App\Livewire\Admin\Employees;

use App\Exports\Employee\EmployeeBankDetails;
use App\Models\Branch;
use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class DisbursementSheet extends Component
{
    use WithPagination;
    public $branch;
    public $branch_options = [];
    public $branch_search;
    public $perPage = 10;
    
    public function mount()
    {
        $this->loadBranches();
    }
    
    public function updatedBranchSearch()
    {
        $this->loadBranches();
    }

    public function exportSheet()
    {
        $fileName = 'employee-bank-details-' . date('Y-m-d-His') . '.xlsx';
        return Excel::download(new EmployeeBankDetails($this->branch), $fileName);
    }

    public function loadBranches()
    {
        $this->branch_options = Branch::whereHas('employees')->when($this->branch_search, function ($query) {
            $query->where('name', 'like', '%' . $this->branch_search . '%');
        })->take(6)->orderBy('name')->pluck('name', 'id')->toArray();
    }
    
    public function render()
    {
        $employees = Employee::with('branch')->when($this->branch, function ($query) {
            $query->where('branch_id', $this->branch);
        })->paginate($this->perPage);

        return view('livewire.admin.employees.disbursement-sheet', compact('employees'));
    }
}
