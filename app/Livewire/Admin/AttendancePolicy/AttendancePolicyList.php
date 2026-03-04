<?php
namespace App\Livewire\Admin\AttendancePolicy;

use App\Models\AttendancePolicy;
use Livewire\Component;
use Livewire\WithPagination;

class AttendancePolicyList extends Component
{
    use WithPagination;
    public function deleteAttendancePolicy($policyID)
    {
        $policy = AttendancePolicy::find($policyID);
        if ($policy) {
            $policy->delete();
            flash()->success('Attendance Policy deleted successfully.');
        } else {
            flash()->error('Attendance Policy not found.');
        }
    }

    public function render()
    {
        $attendancePolicies = AttendancePolicy::paginate(10);
        return view('livewire.admin.attendance-policy.attendance-policy-list', compact('attendancePolicies'));
    }
}
