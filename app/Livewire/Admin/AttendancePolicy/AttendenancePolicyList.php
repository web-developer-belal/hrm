<?php

namespace App\Livewire\Admin\AttendancePolicy;

use App\Models\AttendancePolicy;
use Livewire\Component;
use Livewire\WithPagination;
class AttendenancePolicyList extends Component
{

   use WithPagination;
    public function deleteAttendacePolicy($policyID)
    {
        $policy = AttendancePolicy::find($policyID);
        if ($policy) {
            $policy->delete();
            flash()->success('Attendace Policy deleted successfully.');
        } else {
            flash()->error('Attendace Policy not found.');
        }
    }


    public function render()
    {
        $attendacePolicies = AttendancePolicy::paginate(10);
        return view('livewire.admin.attendance-policy.attendenance-policy-list',compact('attendacePolicies'));
    }
}
