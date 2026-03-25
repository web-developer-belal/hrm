<?php
namespace App\Livewire\Admin\Leavemgt;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LeaveList extends Component
{
    use WithPagination;
    public $branches         = [];
    public $branches_options = [];
    public $branches_search;
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

    public function statusChange($leaveId, $status)
    {
        // dd($leaveId);

        $leave = Leave::findOrFail($leaveId);
        $leave->status = $status;
        if(!empty($leave->approved_by) && $status === 'pending') {
            $leave->approved_by = null;
        } elseif(empty($leave->approved_by) && $status === 'approved') {
            $leave->approved_by = Auth::id();
        }
        
        $leave->save();

        if ($status === 'approved') {
            $this->updateAttendanceForLeave($leave);
        } elseif (in_array($status, ['rejected', 'pending'])) {
            $this->revertAttendanceForLeave($leave);
        }

        flash()->success('Leave status change updated successfully.');
    }

    public function deleteLeave($id)
    {

        $leave = Leave::findOrFail($id)->delete();
        // $leave->delete();
        flash()->success('Leave status change updated successfully.');
    }

    public function render()
    {
        $query = Leave::with('employee')
            ->when($this->search, function ($q) {
                $q->whereHas('employee', function ($empQuery) {
                    $empQuery->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')
                        ->orWhere('employee_code', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->branches, function ($q) {
                $q->whereIn('branch_id', (array) $this->branches);
            })->latest()->paginate(10);
            
        return view('livewire.admin.leavemgt.leave-list', [
            'leaves' => $query,
        ]);
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
}
