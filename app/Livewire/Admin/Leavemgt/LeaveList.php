<?php

namespace App\Livewire\Admin\Leavemgt;

use App\Models\Attendance;
use App\Models\Leave;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class LeaveList extends Component
{
      use WithPagination;

      public function statusChange($leaveId, $status)
      {
            // dd($leaveId);

            $leave= Leave::findOrFail($leaveId);
            $leave->update([
                'status'=>$status,
                // 'approved_by'=>Auth::user()->id,
            ]);

            if ($status === 'approved') {
                $this->updateAttendanceForLeave($leave);
            }elseif (in_array($status, ['rejected', 'pending'])) {
                $this->revertAttendanceForLeave($leave);
            }



             flash()->success('Leave status change updated successfully.');
      }

public function deleteLeave($id)
{

    $leave= Leave::findorfail($id)->delete();
    // $leave->delete();
  flash()->success('Leave status change updated successfully.');
}

    public function render()
    {
        $query = Leave::query();
        return view('livewire.admin.leavemgt.leave-list',[
            'leaves' => $query->paginate(10),
        ]);
    }




/**
 * Update attendance records to 'leave' status for the leave date range
 */
private function updateAttendanceForLeave($leave)
{
    Attendance::where('employee_id', $leave->employee_id)
        ->whereBetween('date', [$leave->from_date, $leave->to_date])
        ->update([
            'status' => 'leave',
            'updated_at' => now(),
        ]);
}

/**
 * Revert attendance status if leave is rejected/cancelled
 */
private function revertAttendanceForLeave($leave)
{
    Attendance::where('employee_id', $leave->employee_id)
        ->whereBetween('date', [$leave->from_date, $leave->to_date])
        ->update([
            'status' => 'absent',
            'updated_at' => now(),
        ]);
}
}
