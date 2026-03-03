<?php
namespace App\Livewire\Admin\Attendance;

use App\Models\Attendance;
use App\Models\Branch;
use Livewire\Component;
use Livewire\WithPagination;

class AttendanceList extends Component
{
    use WithPagination;
    public $branches         = [];
    public $branches_options = [];
    public $branches_search;
    public $processDate;
    public $isProcessing = false;
    public $search;

    public function mount()
    {
        $this->loadBranches();
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
            ->whereDate('date', '<=', today())
            ->orderBy('date', 'desc');

        return view('livewire.admin.attendance.attendance-list', [
            'attendancelist' => $query->paginate(10),
        ]);
    }
}
