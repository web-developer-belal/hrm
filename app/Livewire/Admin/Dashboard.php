<?php
namespace App\Livewire\Admin;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Notice;
use Livewire\Attributes\On;
use Livewire\Component;

class Dashboard extends Component
{
    public $startDate;
    public $endDate;

    public $branch;
    public $branch_search;
    public $branch_options = [];

    public function mount()
    {
        $this->startDate = now()->format('Y-m-d');
        $this->endDate   = now()->format('Y-m-d');
        $this->loadBranch();
    }

    public function updatedBranchSearch()
    {
        $this->loadBranch();
    }

    protected function loadBranch(): void
    {
        $this->branch_options = Branch::where('status', 'active')
            ->when($this->branch_search, fn($q) =>
                $q->where('name', 'like', "%{$this->branch_search}%")
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    #[On('date-range-update')]
    public function dateRangeUpdate($start, $end)
    {
        $this->startDate = $start;
        $this->endDate   = $end;
        $this->dispatch('update-chart');
    }

    public function updatedBranch(): void
    {
        $this->dispatch('update-chart');
    }

    public function statusChange($leaveId, $status)
    {
        // dd($leaveId);

        $leave = Leave::findOrFail($leaveId);
        $leave->update([
            'status' => $status,
            // 'approved_by'=>Auth::user()->id,
        ]);

        if ($status === 'approved') {
            $this->updateAttendanceForLeave($leave);
        } elseif (in_array($status, ['rejected', 'pending'])) {
            $this->revertAttendanceForLeave($leave);
        }

        flash()->success('Leave status change updated successfully.');
    }

    private function updateAttendanceForLeave($leave)
    {
        Attendance::where('employee_id', $leave->employee_id)
            ->whereBetween('date', [$leave->from_date, $leave->to_date])
            ->update([
                'status'     => 'leave',
                'updated_at' => now(),
            ]);
    }

    private function revertAttendanceForLeave($leave)
    {
        Attendance::where('employee_id', $leave->employee_id)
            ->whereBetween('date', [$leave->from_date, $leave->to_date])
            ->update([
                'status'     => 'absent',
                'updated_at' => now(),
            ]);
    }

    public function render()
    {
        $dateFilter = fn($q, $column = 'date') =>
        $q->when($this->startDate && $this->endDate,
            fn($qq) => $qq->whereBetween($column, [$this->startDate, $this->endDate])
        );

        $branchFilter = fn($q)                 =>
        $q->when($this->branch, fn($qq) => $qq->where('branch_id', $this->branch));

        // --- Total employees with expected attendance in the date range
        $totalEmployee = $branchFilter(Employee::query())->count();

        // Attendance stats
        $presentRecords = $dateFilter(
            $branchFilter(Attendance::where('status', 'present'))
        );

        $lateRecords = $dateFilter(
            $branchFilter(Attendance::where('status', 'late'))
        );

        $onTimeRecords = $dateFilter(
            $branchFilter(
                Attendance::where('status', 'present')->where('late_minutes', '<=', 0)
            )
        );

        $absentRecords = $dateFilter(
            $branchFilter(
                Attendance::where('status', 'absent')
            )
        );
        $totalAttendance = $dateFilter(
            $branchFilter(
                Attendance::query()
            )
        )->count();

        // --- State for overall stats ---
        $state = [
            'total_employee'          => $totalEmployee,
            'total_present'           => $presentRecords->count(),
            'total_absent'            => $absentRecords->count(),
            'total_on_time'           => $onTimeRecords->count(),
            'total_late'              => $lateRecords->count(),
            'total_leave'             => $branchFilter(
                Leave::where('status', 'approved')
            )->where(fn($q) =>
                $q->whereDate('from_date', '<=', now())
                    ->whereDate('to_date', '>=', now())
            )->count(),
            'total_notice'            => $dateFilter(
                $branchFilter(Notice::query()),
                'created_at'
            )->count(),
            'total_leave_application' => $branchFilter(Leave::where('status', 'pending'))->count(),
        ];

        // Attendance array for Doughnut chart
        $attendance = [
            'total_attendance' => $totalAttendance,
            'present'          => $state['total_present'],
            'late'             => $state['total_late'],
            'on_time'          => $state['total_on_time'],
            'absent'           => $state['total_absent'],
        ];
        // Month-wise Leave chart
        $months        = collect(range(1, 12));
        $approvedLeave = $months->map(fn($m) =>
            Leave::whereStatus('approved')
                ->when($this->branch, fn($q) => $q->where('branch_id', $this->branch))
                ->whereMonth('from_date', '<=', $m)
                ->whereMonth('to_date', '>=', $m)
                ->count()
        )->toArray();

        $pendingLeave = $months->map(fn($m) =>
            Leave::whereStatus('pending')
                ->when($this->branch, fn($q) => $q->where('branch_id', $this->branch))
                ->whereMonth('from_date', '<=', $m)
                ->whereMonth('to_date', '>=', $m)
                ->count()
        )->toArray();

        $leaveMonths = $months->map(fn($m) => \Carbon\Carbon::create()->month($m)->format('M'))->toArray();

        // Latest 5 Leaves & Notices
        $leaves  = $branchFilter(Leave::latest())->take(5)->get();
        $notices = $branchFilter(Notice::latest())->take(5)->get();

        // --- Previous period for change indicators ---
        $periodStart    = \Carbon\Carbon::parse($this->startDate);
        $periodEnd      = \Carbon\Carbon::parse($this->endDate);
        $periodDays     = $periodStart->diffInDays($periodEnd) + 1;
        $prevEnd        = $periodStart->copy()->subDay();
        $prevStart      = $prevEnd->copy()->subDays($periodDays - 1);

        $prevDateFilter = fn($q, $col = 'date') =>
            $q->whereBetween($col, [$prevStart->format('Y-m-d'), $prevEnd->format('Y-m-d')]);

        $prevState = [
            'total_employee'          => $branchFilter(Employee::query())
                ->where('created_at', '<=', $prevEnd->endOfDay())
                ->count(),
            'total_present'           => $prevDateFilter(
                $branchFilter(Attendance::where('status', 'present'))
            )->count(),
            'total_absent'            => $prevDateFilter(
                $branchFilter(Attendance::where('status', 'absent'))
            )->count(),
            'total_on_time'           => $prevDateFilter(
                $branchFilter(
                    Attendance::where('status', 'present')->where('late_minutes', '<=', 0)
                )
            )->count(),
            'total_late'              => $prevDateFilter(
                $branchFilter(Attendance::where('status', 'late'))
            )->count(),
            'total_leave'             => $branchFilter(Leave::where('status', 'approved'))
                ->where(fn($q) =>
                    $q->whereDate('from_date', '<=', $prevEnd)
                        ->whereDate('to_date', '>=', $prevEnd)
                )->count(),
            'total_notice'            => $prevDateFilter(
                $branchFilter(Notice::query()), 'created_at'
            )->count(),
            'total_leave_application' => $branchFilter(Leave::where('status', 'pending'))
                ->where('created_at', '<=', $prevEnd->endOfDay())
                ->count(),
        ];

        $pctChange = fn($current, $previous) => $previous == 0
            ? ($current > 0 ? 100.0 : 0.0)
            : round(($current - $previous) / $previous * 100, 1);

        $changes = [];
        foreach (array_keys($state) as $key) {
            $changes[$key] = $pctChange($state[$key], $prevState[$key]);
        }

        return view('livewire.admin.dashboard', compact(
            'state',
            'attendance',
            'totalEmployee',
            'approvedLeave',
            'pendingLeave',
            'leaveMonths',
            'leaves',
            'notices',
            'changes'
        ));
    }
}
