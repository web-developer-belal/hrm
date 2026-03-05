<?php
namespace App\Livewire\Employ\Leave;

use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\LeaveType;
use Livewire\WithPagination;

class LeaveManagement extends Component
{
    use WithPagination;

    public $employee;
    public $leaveTypes = [];
    public $selectedLeaveType = null;
    public $search;
    public $selectedStatus = null;
    public $statuses = [];

    // ✅ Add these
    public $startDate;
    public $endDate;

    protected $listeners = [
        'date-range-update' => 'updateDateRange',
    ];

    protected $updatesQueryString = ['selectedLeaveType'];

    public function mount()
    {
        $this->employee = Auth::guard('employee')->user();

        $this->leaveTypes = LeaveType::pluck('name', 'id')->toArray();

        $this->statuses = [
            'pending'  => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
        ];

        // Optional default range (example: this year)
        $this->startDate = now()->startOfYear()->format('Y-m-d');
        $this->endDate   = now()->endOfYear()->format('Y-m-d');
    }

    // ✅ This will receive dates from picker
    public function updateDateRange($start, $end)
    {
        $this->startDate = $start;
        $this->endDate   = $end;

        $this->resetPage();
    }

    public function filterByType($typeId)
    {
        $this->selectedLeaveType = $typeId;
        $this->resetPage(); // reset pagination after filter
    }

    public function filterByStatus($status)
    {
        $this->selectedStatus = $status;
        $this->resetPage();
    }

    public function render()
    {
        $leaves = Leave::with('type')
            ->where('employee_id', $this->employee->id)

            ->when($this->selectedLeaveType, function ($q) {
                $q->where('leave_type_id', $this->selectedLeaveType);
            })

            ->when($this->selectedStatus, function ($q) {
                $q->where('status', $this->selectedStatus);
            })

            // ✅ Filter using to_date column
            ->when($this->startDate && $this->endDate, function ($q) {
                $q->whereBetween('to_date', [
                    $this->startDate,
                    $this->endDate
                ]);
            })

            ->latest()
            ->paginate(10);

        return view('livewire.employ.leave.leave-management', compact('leaves'));
    }
}
