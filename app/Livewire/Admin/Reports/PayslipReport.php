<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Payroll;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PayslipReport extends Component
{
    use WithPagination;

    public $startDate;
    public $endDate;
    public $branch;
    public $branch_options = [];
    public $branch_search = '';
    public $department;
    public $department_options = [];
    public $department_search = '';
    public $employee;
    public $employee_options = [];
    public $employee_search = '';

    public function mount()
    {
        $this->startDate = now()->startOfYear()->format('Y-m-d');
        $this->endDate = now()->endOfYear()->format('Y-m-d');

        $this->loadBranches();
        $this->loadDepartments();
        $this->loadEmployees();
    }

    public function loadBranches()
    {
        $this->branch_options = Branch::query()
            ->whereHas('departments')
            ->where('status', 'active')
            ->when($this->branch_search, fn($query) =>
                $query->where('name', 'like', '%' . $this->branch_search . '%')
            )
            ->orderBy('name')
            ->take(10)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function loadDepartments()
    {
        $this->department_options = Department::query()
            ->when($this->branch, fn($query) => $query->where('branch_id', $this->branch))
            ->where('status', 'active')
            ->when($this->department_search, fn($query) =>
                $query->where('name', 'like', '%' . $this->department_search . '%')
            )
            ->orderBy('name')
            ->take(10)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function loadEmployees()
    {
        $this->employee_options = Employee::query()
            ->where('status', 1)
            ->when($this->branch, fn($query) => $query->where('branch_id', $this->branch))
            ->when($this->department, fn($query) => $query->where('department_id', $this->department))
            ->when($this->employee_search, function ($query) {
                $query->where(function ($employeeQuery) {
                    $employeeQuery->where('first_name', 'like', '%' . $this->employee_search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->employee_search . '%')
                        ->orWhere('employee_code', 'like', '%' . $this->employee_search . '%');
                });
            })
            ->orderBy('first_name')
            ->take(10)
            ->get()
            ->mapWithKeys(fn($employee) => [
                $employee->id => $employee->full_name . ' (' . $employee->employee_code . ')',
            ])
            ->toArray();
    }

    public function updatedBranchSearch()
    {
        $this->loadBranches();
    }

    public function updatedDepartmentSearch()
    {
        $this->loadDepartments();
    }

    public function updatedEmployeeSearch()
    {
        $this->loadEmployees();
    }

    public function updatedBranch()
    {
        $this->department = null;
        $this->employee = null;

        $this->loadDepartments();
        $this->loadEmployees();
        $this->refreshReportData();
    }

    public function updatedDepartment()
    {
        $this->employee = null;

        $this->loadEmployees();
        $this->refreshReportData();
    }

    public function updatedEmployee()
    {
        $this->refreshReportData();
    }

    #[On('date-range-update')]
    public function dateRangeUpdate($start, $end)
    {
        $this->startDate = $start;
        $this->endDate = $end;

        $this->refreshReportData();
    }

    private function refreshReportData(): void
    {
        $this->resetPage();

        $this->dispatch('update-chart',
            chartData: $this->getChartData(),
            stats: $this->getStats()
        );
    }

    private function payrollQuery()
    {
        return Payroll::query()
            ->when($this->branch, fn($query) => $query->where('branch_id', $this->branch))
            ->when($this->department, function ($query) {
                $query->whereHas('employee', function ($employeeQuery) {
                    $employeeQuery->where('department_id', $this->department);
                });
            })
            ->when($this->employee, fn($query) => $query->where('employee_id', $this->employee));
    }

    private function applyPeriodFilter($query, $startDate, $endDate)
    {
        return $query
            ->whereDate('period_start', '<=', $endDate)
            ->whereDate('period_end', '>=', $startDate);
    }

    public function getStats()
    {
        $payrolls = $this->applyPeriodFilter($this->payrollQuery(), $this->startDate, $this->endDate)->get();

        $totalPayroll = $payrolls->sum('gross_salary');
        $totalDeductions = $payrolls->sum('total_deduction');
        $netPay = $payrolls->sum('net_salary');
        $allowances = $payrolls->sum(function ($payslip) {
            return ($payslip->attendance_bonus ?? 0) + ($payslip->positive_adjustments ?? 0);
        });

        $daysDiff = max(1, Carbon::parse($this->startDate)->diffInDays(Carbon::parse($this->endDate)) + 1);
        $prevStart = Carbon::parse($this->startDate)->subDays($daysDiff)->format('Y-m-d');
        $prevEnd = Carbon::parse($this->startDate)->subDay()->format('Y-m-d');

        $prevPayrolls = $this->applyPeriodFilter($this->payrollQuery(), $prevStart, $prevEnd)->get();

        $prevTotalPayroll = $prevPayrolls->sum('gross_salary');
        $prevTotalDeductions = $prevPayrolls->sum('total_deduction');
        $prevNetPay = $prevPayrolls->sum('net_salary');
        $prevAllowances = $prevPayrolls->sum(function ($payslip) {
            return ($payslip->attendance_bonus ?? 0) + ($payslip->positive_adjustments ?? 0);
        });

        return [
            'totalPayroll' => [
                'amount' => $totalPayroll,
                'percentage' => $prevTotalPayroll > 0 ? round((($totalPayroll - $prevTotalPayroll) / $prevTotalPayroll) * 100, 2) : 0,
            ],
            'totalDeductions' => [
                'amount' => $totalDeductions,
                'percentage' => $prevTotalDeductions > 0 ? round((($totalDeductions - $prevTotalDeductions) / $prevTotalDeductions) * 100, 2) : 0,
            ],
            'netPay' => [
                'amount' => $netPay,
                'percentage' => $prevNetPay > 0 ? round((($netPay - $prevNetPay) / $prevNetPay) * 100, 2) : 0,
            ],
            'allowances' => [
                'amount' => $allowances,
                'percentage' => $prevAllowances > 0 ? round((($allowances - $prevAllowances) / $prevAllowances) * 100, 2) : 0,
            ],
        ];
    }

    public function getChartData()
    {
        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);

        $categories = [];
        $data = [];

        $current = $start->copy()->startOfMonth();
        $endMonth = $end->copy()->endOfMonth();

        while ($current->lte($endMonth)) {
            $monthStart = $current->copy()->startOfMonth()->format('Y-m-d');
            $monthEnd = $current->copy()->endOfMonth()->format('Y-m-d');

            $categories[] = $current->format('M Y');
            $data[] = round(
                $this->applyPeriodFilter($this->payrollQuery(), $monthStart, $monthEnd)->sum('net_salary'),
                2
            );

            $current->addMonth();
        }

        return [
            'categories' => $categories,
            'series' => [
                [
                    'name' => 'Net Salary',
                    'data' => $data,
                ],
            ],
        ];
    }

    public function render()
    {
        $payslips = $this->applyPeriodFilter($this->payrollQuery(), $this->startDate, $this->endDate)
            ->with(['employee.designation', 'employee.branch', 'branch'])
            ->latest('period_start')
            ->paginate(10);

        return view('livewire.admin.reports.payslip-report', [
            'payslips' => $payslips,
            'stats' => $this->getStats(),
            'chartData' => $this->getChartData(),
        ]);
    }
}
