<?php
namespace App\Livewire\Admin\Payroll;

use App\Exports\Employee\EmployeeBankDetails;
use App\Models\Branch;
use App\Models\Payroll;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PayrollList extends Component
{
    use WithPagination;

    public $search = '';
    public $branch;
    public $branch_options = [];
    public $branch_search;
    public $date;
    public $perPage = 10;

    public $selectedPayroll=[];

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

    public function exportSelected()
    {
        if(!$this->branch){
            flash()->error('Please select a branch to export payroll data.');
            return;
        }
        if (empty($this->selectedPayroll)) {
            flash()->error('No payrolls selected for export.');
            return;
        }

        $payrollIds = implode(',', $this->selectedPayroll);
        return redirect()->route('admin.payroll.export', ['payrolls' => $payrollIds]);
    }

    public function exportDisbursementSheet($mfs = false)
    {
        if (empty($this->selectedPayroll)) {
            flash()->error('No payrolls selected for export.');
            return;
        }
         $fileName = 'Employee-Account-Details-' . date('Y-m-d-His') . '.xlsx';
        return Excel::download(new EmployeeBankDetails($this->selectedPayroll,$mfs), $fileName);
    }

    public function render()
    {
        $query = Payroll::with(['employee', 'branch'])
        ->when($this->search, function ($query) {
            $query->whereHas('employee', function ($q) {
                $q->where('first_name', 'like', '%' . $this->search . '%')
                  ->orWhere('last_name', 'like', '%' . $this->search . '%')->orWhere('employee_id', 'like', '%' . $this->search . '%');
            });
        })->when($this->date, function ($query) {
            $date = explode('-', $this->date);
            if (count($date) == 2) {
                $year = trim($date[0]);
                $month = trim($date[1]);
                $query->where('year', $year)->where('month', $month);
            }
        })
        ->when($this->branch, function ($query) {
            $query->where('branch_id', $this->branch);
        })
        ->latest();
        return view('livewire.admin.payroll.payroll-list', [
            'payrolls' => $query->paginate($this->perPage),
        ]);
    }
}
