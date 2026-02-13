<?php

namespace App\Livewire\Admin\Leavemgt;

use Carbon\Carbon;
use App\Models\Leave;
use App\Models\Shift;
use App\Models\Branch;
use Livewire\Component;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\Department;

class LeaveApplication extends Component
{


 public $isEditMode = false;

     public $employees;
    public $leaveTypes;

    public $employee_id;
    public $leave_type_id;

    public $leave_balance = 0;
    public $from_date;
    public $to_date;
    public $total_days = 0;
    public $description;


    public $branches = [];
    public $departments = [];
    public $shifts = [];
    public $employeesData = [];
    public function mount($roster = null)
    {
        $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', '')->toArray();

        $this->employees  = Employee::all();
        $this->leaveTypes = LeaveType::all();

        $this->employeesData = Employee::pluck('first_name', 'id')->prepend('Select Employee', '')->toArray();

    }


    public function setEmployee($id)
    {
        $this->employee_id = $id;
        $this->recalculateBalance();
    }

        public function setLeaveType($id)
    {
        $this->leave_type_id = $id;
        $this->recalculateBalance();
    }

      public function setFromDate($value)
    {
        $this->from_date = $value;
        $this->calculateDays();
    }

    public function setToDate($value)
    {
        $this->to_date = $value;
        $this->calculateDays();
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

  public function recalculateBalance()
    {
        if (!$this->employee_id || !$this->leave_type_id) {
            $this->leave_balance = 0;
            return;
        }

        $year = Carbon::now()->year;

        $leaveType = LeaveType::find($this->leave_type_id);
        $annualLimit = $leaveType?->annual_limit ?? 0;

        $used = Leave::where('employee_id', $this->employee_id)
            ->where('leave_type_id', $this->leave_type_id)
            ->where('status', 'approved')
            ->whereYear('from_date', $year)
            ->sum('total_days');

        $this->leave_balance = max($annualLimit - $used, 0);
    }

      public function calculateDays()
    {
          $validated = $this->validate([
            'from_date'     => 'required|date',
            'to_date'       => 'required|date|after_or_equal:from_date',
        ]);

        if ($this->from_date && $this->to_date) {
            $from = strtotime($this->from_date);
            $to   = strtotime($this->to_date);

            $this->total_days = ($to >= $from)
                ? (($to - $from) / 86400) + 1
                : 0;
        }
    }

        public function submitApplication()
    {

          $validated = $this->validate([
            'from_date'     => 'required|date',
            'to_date'       => 'required|date|after_or_equal:from_date',
        ]);


        if (!$this->employee_id || !$this->leave_type_id) {
            $this->addError('employee_id', 'Employee and leave type required.');
            return;
        }

        if ($this->total_days > $this->leave_balance) {
            $this->addError('total_days', 'Leave exceeds available balance.');
            return;
        }

        Leave::create([
            'employee_id'   => $this->employee_id,
            'leave_type_id' => $this->leave_type_id,
            'from_date'     => $this->from_date,
            'to_date'       => $this->to_date,
            'total_days'    => $this->total_days,
            'descriptions'   => $this->description,
            'status'        => 'Pending',
        ]);

        session()->flash('success', 'Leave application submitted.');

        $this->reset([
            'employee_id',
            'leave_type_id',
            'leave_balance',
            'from_date',
            'to_date',
            'total_days',
            'description',
        ]);
         return redirect()->route('admin.leavemgt.leave.list');
    }



public function render()
    {
        return view('livewire.admin.leavemgt.leave-application');
    }
}
