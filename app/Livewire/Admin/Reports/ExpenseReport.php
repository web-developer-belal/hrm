<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Expense;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseReport extends Component
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
        $this->startDate = now()->subMonth()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');

        $this->loadBranches();
        $this->loadDepartments();
        $this->loadEmployees();
    }

    public function loadBranches()
    {
        $this->branch_options = Branch::query()
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

    private function expenseQuery()
    {
        return Expense::query()
            ->when($this->branch, fn($query) => $query->where('branch_id', $this->branch))
            ->when($this->department, function ($query) {
                $query->whereHas('branch.departments', function ($departmentQuery) {
                    $departmentQuery->where('id', $this->department);
                });
            })
            ->when($this->employee, function ($query) {
                $query->whereHas('branch.employees', function ($employeeQuery) {
                    $employeeQuery->where('id', $this->employee);
                });
            });
    }

    public function getStats()
    {
        $expenses = $this->expenseQuery()
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->get();

        $totalExpense = $expenses->sum('amount');
        $totalCount = $expenses->count();
        $averageExpense = $totalCount > 0 ? $totalExpense / $totalCount : 0;
        $highestExpense = $expenses->max('amount') ?? 0;

        $daysDiff = max(1, Carbon::parse($this->startDate)->diffInDays(Carbon::parse($this->endDate)) + 1);
        $prevStart = Carbon::parse($this->startDate)->subDays($daysDiff)->format('Y-m-d');
        $prevEnd = Carbon::parse($this->startDate)->subDay()->format('Y-m-d');

        $prevExpenses = $this->expenseQuery()
            ->whereBetween('date', [$prevStart, $prevEnd])
            ->get();

        $prevTotalExpense = $prevExpenses->sum('amount');
        $prevTotalCount = $prevExpenses->count();
        $prevAverageExpense = $prevTotalCount > 0 ? $prevTotalExpense / $prevTotalCount : 0;
        $prevHighestExpense = $prevExpenses->max('amount') ?? 0;

        return [
            'totalExpense' => [
                'amount' => $totalExpense,
                'percentage' => $prevTotalExpense > 0 ? round((($totalExpense - $prevTotalExpense) / $prevTotalExpense) * 100, 2) : 0,
            ],
            'totalCount' => [
                'count' => $totalCount,
                'percentage' => $prevTotalCount > 0 ? round((($totalCount - $prevTotalCount) / $prevTotalCount) * 100, 2) : 0,
            ],
            'averageExpense' => [
                'amount' => $averageExpense,
                'percentage' => $prevAverageExpense > 0 ? round((($averageExpense - $prevAverageExpense) / $prevAverageExpense) * 100, 2) : 0,
            ],
            'highestExpense' => [
                'amount' => $highestExpense,
                'percentage' => $prevHighestExpense > 0 ? round((($highestExpense - $prevHighestExpense) / $prevHighestExpense) * 100, 2) : 0,
            ],
        ];
    }

    public function getChartData()
    {
        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);

        $categories = [];
        $expenseData = [];

        if ($start->diffInDays($end) > 60) {
            $current = $start->copy()->startOfMonth();
            $endMonth = $end->copy()->endOfMonth();

            while ($current->lte($endMonth)) {
                $monthStart = $current->copy()->startOfMonth();
                $monthEnd = $current->copy()->endOfMonth();

                $categories[] = $current->format('M Y');
                $expenseData[] = round(
                    $this->expenseQuery()->whereBetween('date', [$monthStart, $monthEnd])->sum('amount'),
                    2
                );

                $current->addMonth();
            }
        } else {
            $current = $start->copy();

            while ($current->lte($end)) {
                $categories[] = $current->format('M d');
                $expenseData[] = round(
                    $this->expenseQuery()->whereDate('date', $current)->sum('amount'),
                    2
                );

                $current->addDay();
            }
        }

        return [
            'categories' => $categories,
            'expenses' => $expenseData,
        ];
    }

    public function render()
    {
        $expenses = $this->expenseQuery()
            ->with(['branch', 'type'])
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->latest('date')
            ->paginate(10);

        return view('livewire.admin.reports.expense-report', [
            'expenses' => $expenses,
            'stats' => $this->getStats(),
            'chartData' => $this->getChartData(),
        ]);
    }
}
