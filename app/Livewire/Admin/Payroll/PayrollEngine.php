<?php
namespace App\Livewire\Admin\Payroll;

use App\Models\Branch;
use App\Models\BranchGroup;
use App\Services\Payroll\PayrollService;
use Carbon\Carbon;
use Livewire\Component;

class PayrollEngine extends Component
{
    public $branch_id;
    public $branch_group_id;
    public $year;
    public $month;

    public $branch_id_options = [];
    public $branch_group_id_options = [];
    public $branch_id_search;
    public $branch_group_id_search;

    protected $rules = [
        'branch_id' => 'required',
        'year'      => 'required|numeric',
        'month'     => 'required|numeric|min:1|max:12',
    ];

    protected $payrollService;

    public function boot(PayrollService $payrollService)
    {
        $this->payrollService = $payrollService;
    }

    public function mount()
    {
        $this->loadBranches();
        $this->loadBranchGroups();
        $this->year  = now()->year;
        $this->month = now()->month;
    }

    protected function loadBranches(): void
    {
        $this->branch_id_options = Branch::query()
            ->where('status', 'active')
            ->when($this->branch_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branch_id_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    protected function loadBranchGroups(): void
    {
        $this->branch_group_id_options = BranchGroup::query()
            ->when($this->branch_group_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branch_group_id_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedBranchIdSearch(): void
    {
        $this->loadBranches();
    }

    public function updatedBranchGroupIdSearch(): void
    {
        $this->loadBranchGroups();
    }

    //  Generate selected Branch
    public function generateBranch()
    {

        $this->validate();
        // dd($this->branch_id);
        $totalDays = Carbon::create($this->year, $this->month, 1)->daysInMonth;
        $count     = $this->payrollService->generateForBranch(
            $this->branch_id,
            $this->year,
            $this->month,
            $totalDays,
        );

        flash()->success("$count payrolls generated for all branches.");
    }

    // Generate All Branches Salary
    public function generateAll()
    {

        $this->validate([
            'year'  => 'required',
            'month' => 'required',
        ]);

        $totalDays = Carbon::create($this->year, $this->month, 1)->daysInMonth;

        $count = $this->payrollService->generateForAllBranches(
            $this->year,
            $this->month,
            $totalDays,
        );

        flash()->success("$count payrolls generated for all branches.");

    }

    public function generateBranchGroup()
    {
        $this->validate([
            'branch_group_id' => 'required|exists:branch_groups,id',
            'year'            => 'required|numeric',
            'month'           => 'required|numeric|min:1|max:12',
        ]);

        $totalDays = Carbon::create($this->year, $this->month, 1)->daysInMonth;

        $count = $this->payrollService->generateForBranchGroup(
            $this->branch_group_id,
            $this->year,
            $this->month,
            $totalDays,
        );

        flash()->success("$count payrolls generated for selected branch group.");
    }

    public function render()
    {

        return view('livewire.admin.payroll.payroll-engine');
    }
}
