<?php

namespace App\Livewire\Admin\Leavemgt;

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

            $leave= Leave::findorfail($leaveId);
            $leave->update([
                'status'=>$status,
                // 'approved_by'=>Auth::user()->id,
            ]);

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
}
