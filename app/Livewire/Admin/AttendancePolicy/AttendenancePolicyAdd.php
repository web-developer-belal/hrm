<?php

namespace App\Livewire\Admin\AttendancePolicy;

use App\Models\AttendancePolicy;
use App\Models\Branch;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AttendenancePolicyAdd extends Component
{
      public $isEditMode = false;



    public $branches = [];
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

    #[Validate('required')]
    public $status;
    public $attendentPolicy;

        public function mount($policyID = null)
    {

        $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', 0)->toArray();

        if ($policyID) {
            $this->isEditMode = true;
            $this->attendentPolicy = AttendancePolicy::findOrFail($policyID);
            $this->policy_name = $this->attendentPolicy->policy_name;
            $this->branch_id = $this->attendentPolicy->branch_id;
            $this->description = $this->attendentPolicy->description;
            $this->in_grace_period_minutes = $this->attendentPolicy->in_grace_period_minutes;
            $this->out_grace_period_minutes = $this->attendentPolicy->out_grace_period_minutes;
            $this->late_deduction_count_days = $this->attendentPolicy->late_deduction_count_days;
            $this->status = $this->attendentPolicy->status;
        }
    }

public function save()
    {
          $this->validate();

        if ($this->isEditMode) {
            $this->attendentPolicy->update([
                'policy_name' =>$this->policy_name,
                'branch_id' =>$this->branch_id,
                'description' =>$this->description,
                'in_grace_period_minutes' =>$this->in_grace_period_minutes,
                'out_grace_period_minutes' =>$this->out_grace_period_minutes,
                'late_deduction_count_days' =>$this->late_deduction_count_days,
                'status' =>$this->status,
            ]);
            flash()->success('Attendance Policy updated successfully.');
        } else {
            AttendancePolicy::create([
                'policy_name' =>$this->policy_name,
                'branch_id' =>$this->branch_id,
                'description' =>$this->description,
                'in_grace_period_minutes' =>$this->in_grace_period_minutes,
                'out_grace_period_minutes' =>$this->out_grace_period_minutes,
                'late_deduction_count_days' =>$this->late_deduction_count_days,
                'status' =>$this->status,
            ]);
            flash()->success('Attendance Policy created successfully.');
        }

        return redirect()->route('admin.attendace-policy.index');
    }



    public function render()
    {
        return view('livewire.admin.attendance-policy.attendenance-policy-add');
    }
}
