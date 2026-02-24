<?php
namespace App\Livewire\Admin\Roster;

use App\Http\Requests\RosterRequest;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Roster;
use App\Models\Shift;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
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

    public $status = 'active';

    public $working_days    = [];
    public $weekly_off_days = [];
    public $employees       = [];

    public $branches          = [];
    public $departments       = [];
    public $shifts            = [];
    public $employees_options = [];
    public $employees_search;

    public $working_days_options = [
        'monday'    => 'Monday',
        'tuesday'   => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday'  => 'Thursday',
        'friday'    => 'Friday',
        'saturday'  => 'Saturday',
        'sunday'    => 'Sunday',
    ];
    public $weekly_off_days_options = [
        'monday'    => 'Monday',
        'tuesday'   => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday'  => 'Thursday',
        'friday'    => 'Friday',
        'saturday'  => 'Saturday',
        'sunday'    => 'Sunday',
    ];

    public function mount($roster = null)
    {
        $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', '')->toArray();

        $this->departments = Department::where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();

        $this->shifts = Shift::where('status', 'active')->pluck('name', 'id')->prepend('Select Shift', '')->toArray();

        $this->getEmployee();

        if ($roster) {
            $this->isEditMode = true;
            $this->roster     = Roster::findOrFail($roster);

            $this->name            = $this->roster->name;
            $this->department_id   = $this->roster->department_id;
            $this->branch_id       = $this->roster->branch_id;
            $this->shift_id        = $this->roster->shift_id;
            $this->start_date      = $this->roster->start_date->format('Y-m-d');
            $this->end_date        = $this->roster->end_date->format('Y-m-d');
            $this->working_days    = $this->roster->working_days ?? [];
            $this->weekly_off_days = $this->roster->weekly_off_days ?? [];
            $this->status          = $this->roster->status;

            $this->employees = $this->roster->employees()->pluck('employees.id')->toArray();
        }
    }

    public function updatedEmployeesSearch()
    {
        $this->getEmployee();
    }

    public function getEmployee()
    {
        $this->employees_options = Employee::query()
            ->where('status', 'active')
            ->when($this->employees_search, function ($query) {
                $search = '%' . $this->employees_search . '%';

                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', $search)
                        ->orWhere('last_name', 'like', $search)
                        ->orWhere('contact_number', 'like', $search)
                        ->orWhere('alternative_phone_number', 'like', $search)
                        ->orWhere('employee_code', 'like', $search);
                });
            })
            ->latest()
            ->take(5)
            ->get()
            ->mapWithKeys(function ($employee) {
                return [
                    $employee->id => $employee->first_name . ' ' . $employee->last_name,
                ];
            })
            ->prepend('Select Employee', '')
            ->toArray();
    }

    public function save()
    {
        $data = $this->validate((new RosterRequest())->rules(), (new RosterRequest())->messages());

        DB::transaction(function () use ($data) {
            if ($this->isEditMode) {
                $this->roster->update($data);
                return;
            }
            // Create roster
            $this->roster = Roster::create($data);
            // load shift relation
            $this->roster->load('shift');

            // Attach employees
            $syncData = [];

            foreach ($this->employees as $empId) {
                $syncData[$empId] = [
                    'shift_id' => $this->shift_id, // important
                ];
            }

            $this->roster->employees()->sync($syncData);

            // Generate attendance
            $period = CarbonPeriod::create($this->start_date, $this->end_date);

            foreach ($period as $date) {
                $dayName = strtolower($date->format('l'));

                // weekly off
                if (in_array($dayName, $this->weekly_off_days)) {
                    $status = 'offday';
                } else {
                    $status = null;
                }

                foreach ($this->employees as $empId) {
                    Attendance::create([
                        'branch_id'        => $this->branch_id,
                        'employee_id'      => $empId,
                        'roster_id'        => $this->roster->id,
                        'date'             => $date->toDateString(),
                        'shift_start_time' => $this->roster->shift->start_time,
                        'shift_end_time'   => $this->roster->shift->end_time,
                        'status'           => $status,
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
