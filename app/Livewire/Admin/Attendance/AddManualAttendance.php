<?php

namespace App\Livewire\Admin\Attendance;

use App\Models\Attendance;
use App\Models\Branch;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Department;
use Carbon\Carbon;
use Livewire\Attributes\Validate;

class AddManualAttendance extends Component
{
    public $employees = [];

    public $branches = [];
    public $departments = [];
    public $employeesData = [];

    #[Validate('required|exists:branches,id')]
    public ?int $selectedBranch;

    #[Validate('required|exists:branches,id')]
    public ?int $selectedDepartment;

    #[Validate('required')]
    public $selectedEmployee;

    #[Validate('required')]
    public $attandenceTime;

    #[Validate('required')]
    public $clockInOut;

    public function mount($roster = null)
    {
        $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', '')->toArray();
        $this->departments = Department::where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();
        $this->employeesData = Employee::pluck('first_name', 'id')->prepend('Select Employee', '')->toArray();
    }

    public function updatedSelectedBranch()
    {
        $this->departments = Department::where('branch_id', $this->selectedBranch)->where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();
    }

    public function updatedselectedDepartment()
    {
        // dd($this->selectedDepartment);
        $this->employeesData = Employee::where('department_id', $this->selectedDepartment)->where('status', 1)->pluck('first_name', 'id')->prepend('Select Employee', '')->toArray();
    }

    public function saveManualAttendance()
    {
        // $this->validate();

        // dd($this->attandenceTime);
        $validated = $this->validate([
            'attandenceTime' => 'required|date_format:Y-m-d\TH:i',
        ]);

        $manualTime = Carbon::parse($this->attandenceTime);
        $dateString = $manualTime->format('Y-m-d');

        $checkRosterEmp = Attendance::where('employee_id', $this->selectedEmployee)->where('date', $dateString)->first();

        if (!$checkRosterEmp) {
            flash()->error("Roster not found for $dateString. Please create a roster first.");
            return;
        }

        $cleanDate = Carbon::parse($checkRosterEmp->date)->format('Y-m-d');
        $shiftStart = Carbon::parse($cleanDate . ' ' . $checkRosterEmp->shift_start_time);
        $shiftEnd = Carbon::parse($cleanDate . ' ' . $checkRosterEmp->shift_end_time);

        $checkRosterEmp->remarks = 'Manual';

        if ($this->clockInOut === 'clockIn') {
            $lateTime = '00:00:00';

            if ($manualTime->greaterThan($shiftStart)) {

                $secondsLate = $shiftStart->diffInSeconds($manualTime);
                $lateTime = gmdate('H:i:s', $secondsLate);
            }

            $checkRosterEmp->clock_in = $manualTime->format('H:i:s');
            $checkRosterEmp->late_minutes = $lateTime;
            $checkRosterEmp->status = 'late';
        } else {
            $overTime = '00:00:00';
            $earlyExit = '00:00:00';

            if ($manualTime->greaterThan($shiftEnd)) {
                $secondsOver = $shiftEnd->diffInSeconds($manualTime);
                $overTime = gmdate('H:i:s', $secondsOver);

            } elseif ($manualTime->lessThan($shiftEnd)) {

                $secondsEarly = $manualTime->diffInSeconds($shiftEnd);
                $earlyExit = gmdate('H:i:s', $secondsEarly);
                $checkRosterEmp->status = 'early exit';

            }

            $checkRosterEmp->clock_out = $manualTime->format('H:i:s');
            $checkRosterEmp->overtime_minutes = $overTime;
            $checkRosterEmp->early_exit_minutes = $earlyExit;
        }

        $checkRosterEmp->save();
        flash()->success('Attendance updated successfully.');
        return redirect()->route('admin.attendance.index');
    }

    public function render()
    {
        return view('livewire.admin.attendance.add-manual-attendance');
    }
}
