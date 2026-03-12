<?php

namespace App\Livewire\Ot;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\BranchGroup;
use App\Models\Employee;
use App\Models\Ot;
use App\Models\OtPayment;
use App\Services\Payroll\PayrollService;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class OtPaymentManagement extends Component
{
    use WithPagination;

    public int    $year;
    public int    $month;
    public string $search          = '';
    public string $branch_group_id = '';
    public string $branch_id       = '';

    public array $branch_group_options = [];
    public array $branch_options       = [];
    public array $month_options        = [];
    public array $selectedEmployeeIds  = [];
    public bool $selectPage            = false;

    public function mount(): void
    {
        $this->year  = (int) now()->format('Y');
        $this->month = (int) now()->format('m');

        $this->branch_group_options = BranchGroup::pluck('name', 'id')->toArray();
        $this->branch_options       = Branch::pluck('name', 'id')->toArray();
        $this->month_options        = collect(range(1, 12))
            ->mapWithKeys(fn ($m) => [$m => Carbon::create(null, $m)->format('F')])
            ->toArray();
    }

    public function updatedBranchGroupId(): void
    {
        $this->branch_id = '';
        $this->branch_options = $this->branch_group_id
            ? Branch::where('branch_group_id', $this->branch_group_id)->pluck('name', 'id')->toArray()
            : Branch::pluck('name', 'id')->toArray();

        $this->clearSelection();
        $this->resetPage();
    }

    public function updatedYear(): void
    {
        $this->clearSelection();
        $this->resetPage();
    }

    public function updatedMonth(): void
    {
        $this->clearSelection();
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->clearSelection();
        $this->resetPage();
    }

    public function updatedBranchId(): void
    {
        $this->clearSelection();
        $this->resetPage();
    }

    public function updatedSelectPage(bool $value): void
    {
        if (! $value) {
            $this->selectedEmployeeIds = [];
            return;
        }

        $this->selectedEmployeeIds = $this->getPageSelectableEmployeeIds();
    }

    public function markAsPaid(int $employeeId): void
    {
        $employee = $this->baseEmployeeQuery()
            ->where('id', $employeeId)
            ->first();

        if (! $employee) {
            session()->flash('error', 'Employee not found for OT payment.');
            return;
        }

        $payment = $this->createOrMarkPaid($employee);

        if (! $payment) {
            session()->flash('error', 'No payable OT found for this employee in the selected period.');
            return;
        }

        $this->selectedEmployeeIds = array_values(array_diff($this->selectedEmployeeIds, [$employeeId]));
        $this->selectPage = false;
        session()->flash('success', 'OT payment created and marked as paid.');
    }

    public function markSelectedAsPaid(): void
    {
        if ($this->selectedEmployeeIds === []) {
            session()->flash('error', 'Select at least one employee to pay OT.');
            return;
        }

        $employees = $this->baseEmployeeQuery()
            ->whereIn('id', $this->selectedEmployeeIds)
            ->get()
            ->keyBy('id');

        $paidCount = 0;

        foreach ($this->selectedEmployeeIds as $employeeId) {
            $employee = $employees->get($employeeId);

            if (! $employee) {
                continue;
            }

            if ($this->createOrMarkPaid($employee)) {
                $paidCount++;
            }
        }

        $this->clearSelection();

        if ($paidCount === 0) {
            session()->flash('error', 'No OT payments were created for the selected employees.');
            return;
        }

        session()->flash('success', $paidCount . ' OT payment(s) created and marked as paid.');
    }

    public function render()
    {
        $paginator = $this->baseEmployeeQuery()->paginate(15);
        $rows = $this->buildRows($paginator->getCollection());

        $this->selectedEmployeeIds = array_values(array_intersect(
            $this->selectedEmployeeIds,
            $rows->filter(fn (array $row) => $row['can_mark_paid'])->pluck('employee.id')->all()
        ));

        if ($this->selectPage) {
            $this->selectedEmployeeIds = $rows
                ->filter(fn (array $row) => $row['can_mark_paid'])
                ->pluck('employee.id')
                ->all();
        }

        $paginator = new LengthAwarePaginator(
            $rows,
            $paginator->total(),
            $paginator->perPage(),
            $paginator->currentPage(),
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('livewire.ot.ot-payment-management', [
            'rows'      => $rows,
            'paginator' => $paginator,
        ]);
    }

    protected function clearSelection(): void
    {
        $this->selectedEmployeeIds = [];
        $this->selectPage = false;
    }

    protected function baseEmployeeQuery()
    {
        $eligibleBranchGroupIds = Ot::query()
            ->where('include_in_payroll', false)
            ->whereNotNull('branch_group_id')
            ->pluck('branch_group_id')
            ->unique()
            ->values()
            ->all();

        return Employee::query()
            ->where('status', 1)
            ->where('has_ot', true)
            ->with(['branch', 'salaryData'])
            ->whereHas('branch', fn ($q) => $q->whereIn('branch_group_id', $eligibleBranchGroupIds))
            ->when($this->search, fn ($q) =>
                $q->where(fn ($sub) =>
                    $sub->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name', 'like', "%{$this->search}%")
                        ->orWhere('employee_code', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                )
            )
            ->when($this->branch_id, fn ($q) => $q->where('branch_id', $this->branch_id))
            ->when($this->branch_group_id && ! $this->branch_id, fn ($q) =>
                $q->whereHas('branch', fn ($b) => $b->where('branch_group_id', $this->branch_group_id))
            )
            ->orderBy('first_name')
            ->orderBy('last_name');
    }

    protected function buildRows($employees)
    {
        $employeeIds = $employees->pluck('id')->all();
        $attendancesByEmployee = $this->loadAttendanceSummaries($employeeIds);
        $otConfigsByGroup = Ot::query()
            ->whereNotNull('branch_group_id')
            ->orderByDesc('id')
            ->get()
            ->unique('branch_group_id')
            ->keyBy('branch_group_id');

        $otPayments = OtPayment::query()
            ->whereIn('employee_id', $employeeIds)
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->get()
            ->keyBy('employee_id');

        return $employees->map(function (Employee $employee) use ($attendancesByEmployee, $otConfigsByGroup, $otPayments) {
            $attendanceSummary = $attendancesByEmployee->get($employee->id, [
                'regular_overtime_minutes' => 0,
                'holiday_overtime_minutes' => 0,
            ]);
            $otConfig = $otConfigsByGroup->get($employee->branch?->branch_group_id);
            $summary = $this->buildSummaryFromAttendance($employee, $otConfig, $attendanceSummary);
            $otPayment = $otPayments->get($employee->id);

            $isPaid = (bool) ($otPayment?->is_paid);
            $canMarkPaid = $summary['payable_overtime_minutes'] > 0 && ! $isPaid;

            return [
                'employee' => $employee,
                'ot_config' => $otConfig,
                'total_ot_minutes' => $summary['payable_overtime_minutes'],
                'total_ot_hours' => $summary['hours'],
                'ot_payment' => $otPayment,
                'amount' => $otPayment?->amount ?? $summary['amount'],
                'payment_status' => $isPaid ? 'paid' : ($summary['payable_overtime_minutes'] > 0 ? 'unpaid' : 'no_ot'),
                'can_mark_paid' => $canMarkPaid,
            ];
        });
    }

    protected function loadAttendanceSummaries(array $employeeIds)
    {
        if ($employeeIds === []) {
            return collect();
        }

        $start = Carbon::create($this->year, $this->month)->startOfMonth()->toDateString();
        $end = Carbon::create($this->year, $this->month)->endOfMonth()->toDateString();

        return Attendance::query()
            ->whereIn('employee_id', $employeeIds)
            ->whereBetween('date', [$start, $end])
            ->selectRaw(
                "employee_id,
                SUM(CASE WHEN status IN ('holiday', 'offday') THEN overtime_minutes ELSE 0 END) as holiday_overtime_minutes,
                SUM(CASE WHEN status NOT IN ('holiday', 'offday') THEN overtime_minutes ELSE 0 END) as regular_overtime_minutes"
            )
            ->groupBy('employee_id')
            ->get()
            ->mapWithKeys(fn ($row) => [
                $row->employee_id => [
                    'regular_overtime_minutes' => (int) $row->regular_overtime_minutes,
                    'holiday_overtime_minutes' => (int) $row->holiday_overtime_minutes,
                ],
            ]);
    }

    protected function buildSummaryFromAttendance(Employee $employee, ?Ot $otConfig, array $attendanceSummary): array
    {
        if (! $otConfig || $otConfig->include_in_payroll) {
            return [
                'payable_overtime_minutes' => 0,
                'hours' => 0,
                'amount' => 0,
            ];
        }

        $payableOvertimeMinutes = $attendanceSummary['regular_overtime_minutes'];

        if ($otConfig->off_day_counting) {
            $payableOvertimeMinutes += $attendanceSummary['holiday_overtime_minutes'];
        }

        $totalDays = Carbon::create($this->year, $this->month)->daysInMonth;
        $salary = $employee->salaryData;
        $totalPlusSalary = ($salary->basic_salary ?? 0)
            + ($salary->house_rent ?? 0)
            + ($salary->medical_allowance ?? 0)
            + ($salary->dear_allowance ?? 0)
            + ($salary->transport_allowance ?? 0)
            + ($salary->pf_employer_contribution ?? 0)
            + ($salary->other_allowance ?? 0);

        $hours = round($payableOvertimeMinutes / 60, 2);
        $ratePerHour = app(PayrollService::class)->resolveOtRatePerHour($otConfig, $totalPlusSalary, $totalDays);

        return [
            'payable_overtime_minutes' => $payableOvertimeMinutes,
            'hours' => $hours,
            'amount' => round($hours * $ratePerHour, 2),
        ];
    }

    protected function createOrMarkPaid(Employee $employee): ?OtPayment
    {
        $otConfig = Ot::query()
            ->where('branch_group_id', $employee->branch?->branch_group_id)
            ->latest('id')
            ->first();

        $attendanceSummary = $this->loadAttendanceSummaries([$employee->id])->get($employee->id, [
            'regular_overtime_minutes' => 0,
            'holiday_overtime_minutes' => 0,
        ]);
        $summary = $this->buildSummaryFromAttendance($employee, $otConfig, $attendanceSummary);

        if ($summary['payable_overtime_minutes'] <= 0) {
            return null;
        }

        $payload = [
            'branch_id' => $employee->branch_id,
            'employee_id' => $employee->id,
            'year' => $this->year,
            'month' => $this->month,
            'overtime_minutes' => $summary['payable_overtime_minutes'],
            'hours' => (int) round($summary['hours']),
            'amount' => $summary['amount'],
            'date' => Carbon::create($this->year, $this->month)->endOfMonth()->toDateString(),
            'is_paid' => true,
        ];

        try {
            return DB::transaction(function () use ($employee, $payload) {
                $record = OtPayment::query()
                    ->where('employee_id', $employee->id)
                    ->where('year', $this->year)
                    ->where('month', $this->month)
                    ->lockForUpdate()
                    ->first();

                if ($record) {
                    $record->fill($payload);
                    $record->save();

                    return $record;
                }

                return OtPayment::create($payload);
            });
        } catch (QueryException $e) {
            if ($this->isDuplicateKeyException($e)) {
                $record = OtPayment::query()
                    ->where('employee_id', $employee->id)
                    ->where('year', $this->year)
                    ->where('month', $this->month)
                    ->first();

                if ($record) {
                    $record->fill($payload);
                    $record->save();

                    return $record;
                }
            }

            throw $e;
        }
    }

    protected function isDuplicateKeyException(QueryException $e): bool
    {
        return in_array((string) $e->getCode(), ['23000', '23505'], true);
    }

    protected function getPageSelectableEmployeeIds(): array
    {
        return $this->buildRows($this->baseEmployeeQuery()->paginate(15)->getCollection())
            ->filter(fn (array $row) => $row['can_mark_paid'])
            ->pluck('employee.id')
            ->all();
    }
}

