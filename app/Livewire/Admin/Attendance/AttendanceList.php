<?php
namespace App\Livewire\Admin\Attendance;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Payroll;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

use function Symfony\Component\Clock\now;

class AttendanceList extends Component
{
    use WithPagination;
    public $branches         = [];
    public $branches_options = [];
    public $branches_search;
    public $processDate;
    public $isProcessing = false;
    public $search;
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->loadBranches();
        $this->startDate = now()->format('Y-m-d');
        $this->endDate   = now()->format('Y-m-d');
    }

    #[On('date-range-update')]
    public function dateRangeUpdate($start, $end)
    {
        $this->startDate = $start;
        $this->endDate   = $end > now() ? now()->format('Y-m-d') : $end;
        $this->dispatch('update-chart',
            chartData: $this->getChartData(),
            stats: $this->getStats()
        );
    }

    protected function loadBranches(): void
    {
        $this->branches_options = Branch::query()
            ->where('status', 'active')
            ->when($this->branches_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branches_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedBranchesSearch(): void
    {
        $this->loadBranches();
    }

    public function deleteAttendance($attendanceId)
    {
        $attendance = Attendance::findOrFail($attendanceId);
        if ($attendance) {
            $payroll = Payroll::where('employee_id', $attendance->employee_id)
                ->where('year', Carbon::parse($attendance->date)->year)
                ->where('month', Carbon::parse($attendance->date)->month)
                ->first();
            if ($payroll) {
                flash()->error('Cannot delete attendance record. Payroll has already been processed for this month.');
                return;
            }
        }
        $attendance->delete();

        flash()->success('Attendance record deleted successfully.');
    }

    public function processRunningMonth()
    {

        $this->isProcessing = true;

        $year  = now()->year;
        $month = now()->month;

        $service = new \App\Services\Attendance\AttendanceProcessService();

        Attendance::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->cursor()
            ->each(function ($attendance) use ($service) {

                $service->process(
                    $attendance->employee_id,
                    $attendance->date
                );

            });

        flash()->success('Attendance Sync successfully.');
    }

    public function render()
    {
        $query = Attendance::query()
            ->with('employee')
            ->when($this->search, function ($q) {
                $q->whereHas('employee', function ($empQuery) {
                    $empQuery->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')
                        ->orWhere('employee_code', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->branches, function ($q) {
                $q->whereIn('branch_id', (array) $this->branches);
            })
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->orderBy('date', 'desc');

        return view('livewire.admin.attendance.attendance-list', [
            'attendancelist' => $query->paginate(10),
        ]);
    }
}
