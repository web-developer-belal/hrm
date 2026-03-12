<?php
namespace App\Livewire\Admin\AttendancePolicy;

use App\Models\AttendancePolicy;
use App\Models\Branch;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AttendancePolicyAdd extends Component
{
    public $isEditMode = false;

    #[Validate('required')]
    public $policy_name;
    #[Validate('required')]
    public $branch_id;
    #[Validate('nullable|string')]
    public $description;
    #[Validate('nullable|numeric')]
    public $in_grace_period_minutes;
    #[Validate('nullable|numeric')]
    public $out_grace_period_minutes;
    #[Validate('nullable|numeric')]
    public $late_deduction_count_days;
    #[Validate('required|date_format:H:i')]
    public $late_cutoff_time = '10:00';
    #[Validate('required|boolean')]
    public $mark_absent_if_late = true;
    #[Validate('required|integer|min:1')]
    public $late_penalty_threshold_days = 3;
    #[Validate('required|numeric|min:0')]
    public $late_penalty_deduct_days = 1;
    #[Validate('required|integer|min:1')]
    public $continuous_absent_months_for_suspend = 3;
    #[Validate('required|boolean')]
    public $auto_suspend_on_continuous_absence = true;

    #[Validate('required')]
    public $status='active';
    public $attendancePolicy;

    public $branch_id_options = [];
    public $branch_id_search;

    public function mount($policyID = null)
    {

        $this->loadBranchOptions();
        if ($policyID) {
            $this->isEditMode                = true;
            $this->attendancePolicy          = AttendancePolicy::findOrFail($policyID);
            $this->policy_name               = $this->attendancePolicy->policy_name;
            $this->branch_id                 = $this->attendancePolicy->branch_id;
            $this->description               = $this->attendancePolicy->description;
            $this->in_grace_period_minutes   = $this->attendancePolicy->in_grace_period_minutes;
            $this->out_grace_period_minutes  = $this->attendancePolicy->out_grace_period_minutes;
            $this->late_deduction_count_days = $this->attendancePolicy->late_deduction_count_days;
            $this->late_cutoff_time          = $this->attendancePolicy->late_cutoff_time
                ? substr((string) $this->attendancePolicy->late_cutoff_time, 0, 5)
                : '10:00';
            $this->mark_absent_if_late                  = (bool) $this->attendancePolicy->mark_absent_if_late;
            $this->late_penalty_threshold_days          = $this->attendancePolicy->late_penalty_threshold_days;
            $this->late_penalty_deduct_days             = $this->attendancePolicy->late_penalty_deduct_days;
            $this->continuous_absent_months_for_suspend = $this->attendancePolicy->continuous_absent_months_for_suspend;
            $this->auto_suspend_on_continuous_absence   = (bool) $this->attendancePolicy->auto_suspend_on_continuous_absence;
            $this->status                    = $this->attendancePolicy->status;
        }
    }

    private function loadBranchOptions()
    {
        $query = Branch::query()->where('status', 'active');

        if ($this->branch_id_search) {
            $query->where('name', 'like', '%' . $this->branch_id_search . '%');
        }

        $this->branch_id_options = $query->latest()->take(6)->pluck('name', 'id')->toArray();
    }

    public function updatedBranchIdSearch()
    {
        $this->loadBranchOptions();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditMode) {
            $this->attendancePolicy->update([
                'policy_name'               => $this->policy_name,
                'branch_id'                 => $this->branch_id,
                'description'               => $this->description,
                'in_grace_period_minutes'   => $this->in_grace_period_minutes,
                'out_grace_period_minutes'  => $this->out_grace_period_minutes,
                'late_deduction_count_days' => $this->late_deduction_count_days,
                'late_cutoff_time'                     => $this->late_cutoff_time . ':00',
                'mark_absent_if_late'                  => (bool) $this->mark_absent_if_late,
                'late_penalty_threshold_days'          => $this->late_penalty_threshold_days,
                'late_penalty_deduct_days'             => $this->late_penalty_deduct_days,
                'continuous_absent_months_for_suspend' => $this->continuous_absent_months_for_suspend,
                'auto_suspend_on_continuous_absence'   => (bool) $this->auto_suspend_on_continuous_absence,
                'status'                    => $this->status,
            ]);
            flash()->success('Attendance Policy updated successfully.');
        } else {
            AttendancePolicy::create([
                'policy_name'               => $this->policy_name,
                'branch_id'                 => $this->branch_id,
                'description'               => $this->description,
                'in_grace_period_minutes'   => $this->in_grace_period_minutes,
                'out_grace_period_minutes'  => $this->out_grace_period_minutes,
                'late_deduction_count_days' => $this->late_deduction_count_days,
                'late_cutoff_time'                     => $this->late_cutoff_time . ':00',
                'mark_absent_if_late'                  => (bool) $this->mark_absent_if_late,
                'late_penalty_threshold_days'          => $this->late_penalty_threshold_days,
                'late_penalty_deduct_days'             => $this->late_penalty_deduct_days,
                'continuous_absent_months_for_suspend' => $this->continuous_absent_months_for_suspend,
                'auto_suspend_on_continuous_absence'   => (bool) $this->auto_suspend_on_continuous_absence,
                'status'                    => $this->status,
            ]);
            flash()->success('Attendance Policy created successfully.');
        }

        return redirect()->route('admin.attendance-policy.index');
    }

    public function render()
    {
        return view('livewire.admin.attendance-policy.attendance-policy-add');
    }
}
