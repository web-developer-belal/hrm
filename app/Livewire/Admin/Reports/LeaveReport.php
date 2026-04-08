<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class LeaveReport extends Component
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

    private function leaveQuery()
    {
        return Leave::query()
            ->when($this->branch, fn($query) => $query->where('branch_id', $this->branch))
            ->when($this->department, function ($query) {
                $query->whereHas('employee', function ($employeeQuery) {
                    $employeeQuery->where('department_id', $this->department);
                });
            })
            ->when($this->employee, fn($query) => $query->where('employee_id', $this->employee));
    }

    public function statusChange($leaveId, $status)
    {
        $leave = Leave::find($leaveId);

        if ($leave) {
            $leave->status = $status;
            $leave->save();

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Leave status updated successfully!',
            ]);
        }
    }

    public function getStats()
    {
        $leaves = $this->leaveQuery()
            ->whereDate('from_date', '<=', $this->endDate)
            ->whereDate('to_date', '>=', $this->startDate)
            ->get();

        $totalLeaves = $leaves->count();
        $approvedLeaves = $leaves->filter(fn($leave) => strtolower((string) $leave->status) === 'approved')->count();
        $pendingLeaves = $leaves->filter(fn($leave) => strtolower((string) $leave->status) === 'pending')->count();
        $rejectedLeaves = $leaves->filter(fn($leave) => strtolower((string) $leave->status) === 'rejected')->count();

        $daysDiff = max(1, Carbon::parse($this->startDate)->diffInDays(Carbon::parse($this->endDate)) + 1);
        $prevStart = Carbon::parse($this->startDate)->subDays($daysDiff)->format('Y-m-d');
        $prevEnd = Carbon::parse($this->startDate)->subDay()->format('Y-m-d');

        $prevLeaves = $this->leaveQuery()
            ->whereDate('from_date', '<=', $prevEnd)
            ->whereDate('to_date', '>=', $prevStart)
            ->get();

        $prevTotalLeaves = $prevLeaves->count();
        $prevApprovedLeaves = $prevLeaves->filter(fn($leave) => strtolower((string) $leave->status) === 'approved')->count();
        $prevPendingLeaves = $prevLeaves->filter(fn($leave) => strtolower((string) $leave->status) === 'pending')->count();
        $prevRejectedLeaves = $prevLeaves->filter(fn($leave) => strtolower((string) $leave->status) === 'rejected')->count();

        return [
            'totalLeaves' => [
                'count' => $totalLeaves,
                'percentage' => $prevTotalLeaves > 0 ? round((($totalLeaves - $prevTotalLeaves) / $prevTotalLeaves) * 100, 2) : 0,
            ],
            'approvedLeaves' => [
                'count' => $approvedLeaves,
                'percentage' => $prevApprovedLeaves > 0 ? round((($approvedLeaves - $prevApprovedLeaves) / $prevApprovedLeaves) * 100, 2) : 0,
            ],
            'pendingLeaves' => [
                'count' => $pendingLeaves,
                'percentage' => $prevPendingLeaves > 0 ? round((($pendingLeaves - $prevPendingLeaves) / $prevPendingLeaves) * 100, 2) : 0,
            ],
            'rejectedLeaves' => [
                'count' => $rejectedLeaves,
                'percentage' => $prevRejectedLeaves > 0 ? round((($rejectedLeaves - $prevRejectedLeaves) / $prevRejectedLeaves) * 100, 2) : 0,
            ],
        ];
    }

    public function getChartData()
    {
        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);
        $leaveTypes = LeaveType::all();

        $categories = [];
        $series = [];

        foreach ($leaveTypes as $type) {
            $series[$type->id] = [
                'name' => $type->name,
                'data' => [],
            ];
        }

        $current = $start->copy()->startOfMonth();
        $endMonth = $end->copy()->endOfMonth();

        while ($current->lte($endMonth)) {
            $monthStart = $current->copy()->startOfMonth();
            $monthEnd = $current->copy()->endOfMonth();
            $categories[] = $current->format('M');

            foreach ($leaveTypes as $type) {
                $count = $this->leaveQuery()
                    ->where('leave_type_id', $type->id)
                    ->whereRaw('LOWER(status) = ?', ['approved'])
                    ->whereDate('from_date', '<=', $monthEnd)
                    ->whereDate('to_date', '>=', $monthStart)
                    ->count();

                $series[$type->id]['data'][] = $count;
            }

            $current->addMonth();
        }

        return [
            'categories' => $categories,
            'series' => array_values($series),
        ];
    }

    public function render()
    {
        $leaves = $this->leaveQuery()
            ->with(['employee.designation', 'type'])
            ->whereDate('from_date', '<=', $this->endDate)
            ->whereDate('to_date', '>=', $this->startDate)
            ->latest('from_date')
            ->paginate(10);

        return view('livewire.admin.reports.leave-report', [
            'leaves' => $leaves,
            'stats' => $this->getStats(),
            'chartData' => $this->getChartData(),
        ]);
    }
}
