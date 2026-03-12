<?php
namespace App\Livewire\Admin\Payroll;

use App\Models\Branch;
use App\Models\BranchGroup;
use App\Services\Payroll\PayrollService;
use Livewire\Component;

class PayrollEngine extends Component
{
    public $branch_id;
    public $branch_group_id;
    public $period_start;
    public $period_end;

    public $branch_id_options = [];
    public $branch_group_id_options = [];
    public $branch_id_search;
    public $branch_group_id_search;

    protected $rules = [
        'branch_id' => 'required',
        'period_start' => 'required|date',
        'period_end'   => 'required|date|after_or_equal:period_start',
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
        $this->period_start = now()->startOfMonth()->toDateString();
        $this->period_end   = now()->endOfMonth()->toDateString();
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
        $count     = $this->payrollService->generateForBranch(
            $this->branch_id,
            $this->period_start,
            $this->period_end,
        );

        flash()->success("$count payrolls generated for selected branch.");
    }

    // Generate All Branches Salary
    public function generateAll()
    {

        $this->validate([
            'period_start' => 'required|date',
            'period_end'   => 'required|date|after_or_equal:period_start',
        ]);

        $count = $this->payrollService->generateForAllBranches(
            $this->period_start,
            $this->period_end,
        );

        flash()->success("$count payrolls generated for all branches.");

    }

    public function generateBranchGroup()
    {
        $this->validate([
            'branch_group_id' => 'required|exists:branch_groups,id',
            'period_start'    => 'required|date',
            'period_end'      => 'required|date|after_or_equal:period_start',
        ]);

        $count = $this->payrollService->generateForBranchGroup(
            $this->branch_group_id,
            $this->period_start,
            $this->period_end,
        );

        flash()->success("$count payrolls generated for selected branch group.");
    }

    public function render()
    {

        return view('livewire.admin.payroll.payroll-engine');
    }
}
