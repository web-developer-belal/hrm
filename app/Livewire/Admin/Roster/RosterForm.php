<?php

namespace App\Livewire\Admin\Roster;

use DB;
use App\Models\Shift;
use App\Models\Branch;
use App\Models\Roster;
use Livewire\Component;
use App\Models\Employee;
use Carbon\CarbonPeriod;
use App\Models\Attendance;
use App\Models\Department;
use App\Http\Requests\RosterRequest;

class RosterForm extends Component
{
    public $isEditMode = false;
    public $roster;

    public $name;
    public $department_id;
    public $branch_id;
    public $shift_id;
    public $start_date;
    public $end_date;


    public $status = 'active';

    public $working_days = [];
public $weekly_off_days = [];
public $employees = [];

    public $branches = [];
    public $departments = [];
    public $shifts = [];
    public $employeesData = [];

    public function mount($roster = null)
    {
        $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', '')->toArray();

        $this->departments = Department::where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();

        $this->shifts = Shift::where('status', 'active')->pluck('name', 'id')->prepend('Select Shift', '')->toArray();

        $this->employeesData = Employee::pluck('first_name', 'id')->prepend('Select Employee', '')->toArray();

        if ($roster) {
            $this->isEditMode = true;
            $this->roster = Roster::findOrFail($roster);

            $this->name = $this->roster->name;
            $this->department_id = $this->roster->department_id;
            $this->branch_id = $this->roster->branch_id;
            $this->shift_id = $this->roster->shift_id;
            $this->start_date = $this->roster->start_date->format('Y-m-d');
            $this->end_date = $this->roster->end_date->format('Y-m-d');
            $this->working_days = $this->roster->working_days ?? [];
            $this->weekly_off_days = $this->roster->weekly_off_days ?? [];
            $this->status = $this->roster->status;

            $this->employees = $this->roster->employees()->pluck('employees.id')->toArray();
        }
    }

    public function save()
    {
        $data = $this->validate(new RosterRequest()->rules(), new RosterRequest()->messages());

        \DB::transaction(function () use ($data) {
            if ($this->isEditMode) {
                $this->roster->update($data);
                return;
            }
            // Create roster
            $this->roster = Roster::create($data);
            // load shift relation
            $this->roster->load('shift');

            // Attach employees
            $this->roster->employees()->sync($this->employees);

            // Generate attendance
            $period = CarbonPeriod::create($this->start_date, $this->end_date);

            foreach ($period as $date) {
                $dayName = strtolower($date->format('l'));

                // weekly off
               if (in_array($dayName, $this->weekly_off_days)) {
                    $status= 'offday';
                }else{
                    $status= 'absent';
                }

                    foreach ($this->employees as $empId) {
                       $emp= Employee::findorfail($empId);
                        Attendance::create([
                            'branch_id' => $this->branch_id,
                            'employee_id' => $empId,
                            'employee_card_no' => $emp->employee_code,
                            'roster_id' => $this->roster->id,
                            'date' => $date->toDateString(),
                            'shift_start_time' => $this->roster->shift->start_time,
                            'shift_end_time' => $this->roster->shift->end_time,
                            'status' => $status,
                        ]);
                    }

            }
        });
         flash()->success($this->isEditMode ? 'Roster updated successfully.' : 'Roster created successfully.');
        return redirect()->route('admin.rosters.index');


    }

    public function render()
    {
        return view('livewire.admin.roster.roster-form');
    }
}
