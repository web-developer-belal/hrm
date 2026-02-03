<?php

namespace App\Livewire\Admin\Roster;

use App\Http\Requests\RosterRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Roster;
use App\Models\Shift;
use Livewire\Component;

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
    public $working_days = [];
    public $weekly_off_days = [];
    public $status = 'active';
    public $employees = [];

    public $branches = [];
    public $departments = [];
    public $shifts = [];
    public $employeesData = [];

    public function mount($roster = null)
    {
        $this->branches = Branch::where('status','active')->pluck('name', 'id')->prepend('Select Branch','')->toArray();
        $this->departments = Department::where('status','active')->pluck('name', 'id')->prepend('Select Department','')->toArray();
        $this->shifts =Shift::where('status','active')->pluck('name', 'id')->prepend('Select Shift','')->toArray();
        $this->employeesData =Employee::pluck('first_name', 'id')->prepend('Select Employee','')->toArray();

        if ($roster !== null) {
            $this->isEditMode = true;
            $this->roster = Roster::findOrFail($roster);
            $this->name = $this->roster->name;
            $this->department_id = $this->roster->department_id;
            $this->branch_id = $this->roster->branch_id;
            $this->shift_id = $this->roster->shift_id;
            $this->start_date = $this->roster->start_date->format('Y-m-d');
            $this->end_date = $this->roster->end_date->format('Y-m-d');
            $this->working_days = $this->roster->working_days;
            $this->weekly_off_days = $this->roster->weekly_off_days;
            $this->status = $this->roster->status;
            // $this->employees = $this->roster->employees()->pluck('id')->toArray();
        }
    }

    public function save()
    {
        $data = $this->validate((new RosterRequest())->rules(), (new RosterRequest())->messages());

        if ($this->isEditMode) {
            $this->roster->update($data);
        } else {
            $this->roster = Roster::create($data);
        }

        $this->roster->employees()->sync($this->employees);

        flash()->success($this->isEditMode ? 'Roster updated successfully.' : 'Roster created successfully.');
        return redirect()->route('admin.rosters.index');
    }

    public function render()
    {
        return view('livewire.admin.roster.roster-form');
    }
}
