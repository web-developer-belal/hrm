<?php

namespace App\Livewire\Admin\Payroll;

use App\Models\Branch;
use App\Services\Payroll\PayrollService;
use Carbon\Carbon;
use Livewire\Component;

class PayrollEngine extends Component
{
   public $branch_id;
    public $year;
    public $month;

    public $branches = [];

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
        $this->branches = Branch::all();
        $this->year  = now()->year;
        $this->month = now()->month;
    }

    //  Generate selected Branch
    public function generateBranch()
    {


        $this->validate();
    // dd($this->branch_id);
         $totalDays = Carbon::create($this->year, $this->month, 1)->daysInMonth;
        $count = $this->payrollService->generateForBranch(
            $this->branch_id,
            $this->year,
            $this->month,
            $totalDays,
        );


         flash()->success( "$count payrolls generated for all branches.");
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

       flash()->success( "$count payrolls generated for all branches.");

    }
    public function render()
    {

        return view('livewire.admin.payroll.payroll-engine');
    }
}
