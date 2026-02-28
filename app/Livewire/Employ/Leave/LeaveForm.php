<?php
namespace App\Livewire\Employ\Leave;

use App\Models\Leave;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LeaveForm extends Component
{
    public $employee;
   
    public $leaveTypes;

    public $leave_type_id;

    public $leave_balance = 0;
    public $from_date;
    public $to_date;
    public $total_days = 0;
    public $description;

    public function mount()
    {
        $this->employee   = Auth::guard('employee')->user();
        $this->leaveTypes = LeaveType::all();

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
        if (! $this->employee->id || ! $this->leave_type_id) {
            $this->leave_balance = 0;
            return;
        }

        $year = Carbon::now()->year;

        $leaveType   = LeaveType::find($this->leave_type_id);
        $annualLimit = $leaveType?->annual_limit ?? 0;

        $used = Leave::where('employee_id', $this->employee->id)
            ->where('leave_type_id', $this->leave_type_id)
            ->where('status', 'approved')
            ->whereYear('from_date', $year)
            ->sum('total_days');

        $this->leave_balance = max($annualLimit - $used, 0);
    }

    public function calculateDays()
    {
        $this->validate([
            'from_date' => 'required|date',
            'to_date'   => 'required|date|after_or_equal:from_date',
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

        $this->validate([
            'from_date' => 'required|date',
            'to_date'   => 'required|date|after_or_equal:from_date',
        ]);

        if (! $this->leave_type_id) {
            $this->addError('employee_id', 'Employee and leave type required.');
            return;
        }

        if ($this->total_days > $this->leave_balance) {
            $this->addError('total_days', 'Leave exceeds available balance.');
            return;
        }

        Leave::create([
            'employee_id'   => $this->employee->id,
            'leave_type_id' => $this->leave_type_id,
            'from_date'     => $this->from_date,
            'to_date'       => $this->to_date,
            'total_days'    => $this->total_days,
            'descriptions'  => $this->description,
            'status'        => 'Pending',
        ]);

        session()->flash('success', 'Leave application submitted.');

        $this->reset([
            'leave_type_id',
            'leave_balance',
            'from_date',
            'to_date',
            'total_days',
            'description',
        ]);
        return redirect()->route('employee.leave.create');
    }

    public function render()
    {
        return view('livewire.employ.leave.leave-form');
    }
}
