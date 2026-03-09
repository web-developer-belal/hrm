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
    public $branch_id;
    public $department_id;
    public $shift_id;
    public $start_date;
    public $end_date;
    public $status = 'active';

    public $working_days    = [];
    public $weekly_off_days = [];
    public $employees       = [];

    // Branch
    public $branch_id_options = [];
    public $branch_id_search;

    // Department
    public $department_id_options = [];
    public $department_id_search;

    // Employees
    public $employees_options = [];
    public $employees_search;

    // Shift (normal select)
    public $shift_id_options = [];
    public $shift_id_search;

    public $working_days_options = [
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
        $this->loadBranchIdOptions();

        $this->loadShiftIdOptions();

        if ($roster) {
            $this->isEditMode = true;
            $this->roster     = Roster::findOrFail($roster);

            $this->name          = $this->roster->name;
            $this->branch_id     = $this->roster->branch_id;
            $this->department_id = $this->roster->department_id;
            $this->shift_id      = $this->roster->shift_id;
            $this->start_date    = $this->roster->start_date->format('Y-m-d');
            $this->end_date      = $this->roster->end_date->format('Y-m-d');
            $this->working_days  = $this->roster->working_days ?? [];
            $this->status        = $this->roster->status;

            $this->employees = $this->roster
                ->employees()
                ->pluck('employees.id')
                ->toArray();

            // Load dependent dropdowns
            $this->loadDepartmentIdOptions();
            $this->loadEmployeesOptions();
        }
    }

    protected function loadShiftIdOptions()
    {
        $this->shift_id_options = Shift::when($this->shift_id_search, fn($q) =>
            $q->where('name', 'like', '%' . $this->shift_id_search . '%')
        )
        ->where('status', 'active')->take(5)
        ->pluck('name', 'id')
        ->toArray();
    }

    public function updatedShiftIdSearch()
    {
        $this->loadShiftIdOptions();
    }

    protected function loadBranchIdOptions()
    {
        $this->branch_id_options = Branch::whereHas('departments')->where('status', 'active')
            ->when($this->branch_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branch_id_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedBranchIdSearch()
    {
        $this->loadBranchIdOptions();
    }

    public function updatedBranchId()
    {
        $this->department_id         = null;
        $this->employees             = [];
        $this->department_id_options = [];
        $this->employees_options     = [];

        $this->loadDepartmentIdOptions();
    }

    protected function loadDepartmentIdOptions()
    {
        if (! $this->branch_id) {
            $this->department_id_options = [];
            return;
        }

        $this->department_id_options = Department::whereHas('employees')->where('status', 'active')
            ->where('branch_id', $this->branch_id)
            ->when($this->department_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->department_id_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedDepartmentIdSearch()
    {
        $this->loadDepartmentIdOptions();
    }

    public function updatedDepartmentId()
    {
        $this->employees         = [];
        $this->employees_search  = null;
        $this->employees_options = [];

        $this->loadEmployeesOptions();
    }

    protected function loadEmployeesOptions()
    {
        if (! $this->department_id) {
            // dd($this->department_id);
            $this->employees_options = [];
            return;
        }

        $this->employees_options = Employee::where('status', 1)
            ->where('branch_id', $this->branch_id)
            ->where('department_id', $this->department_id)
            ->when($this->employees_search, function ($query) {
                $search = '%' . $this->employees_search . '%';

                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', $search)
                        ->orWhere('last_name', 'like', $search)
                        ->orWhere('contact_number', 'like', $search)
                        ->orWhere('employee_code', 'like', $search);
                });
            })
            ->latest()
            ->limit(5)
            ->get()
            ->mapWithKeys(fn($emp) => [
                $emp->id => $emp->full_name, // using accessor
            ])
            ->toArray();
    }

    public function updatedEmployeesSearch()
    {
        $this->loadEmployeesOptions();
    }

    public function save()
    {
        $allDays = array_keys($this->working_days_options);

        $this->weekly_off_days = array_values(
            array_diff($allDays, $this->working_days ?? [])
        );
        $data = $this->validate(
            (new RosterRequest())->rules(),
            (new RosterRequest())->messages()
        );

        DB::transaction(function () use ($data) {

            if ($this->isEditMode) {
                $this->roster->update($data);
                return;
            }

            $this->roster = Roster::create($data);
            $this->roster->load('shift');

            $syncData = [];

            foreach ($this->employees as $empId) {
                $syncData[$empId] = [
                    'shift_id' => $this->shift_id,
                ];
            }

            $this->roster->employees()->sync($syncData);

            $period = CarbonPeriod::create($this->start_date, $this->end_date);

            foreach ($period as $date) {

                $dayName = strtolower($date->format('l'));

                $status = in_array($dayName, $this->working_days)
                    ? null
                    : 'offday';

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

        flash()->success(
            $this->isEditMode
                ? 'Roster updated successfully.'
                : 'Roster created successfully.'
        );

        return redirect()->route('admin.rosters.index');
    }

    public function render()
    {
        return view('livewire.admin.roster.roster-form');
    }
}
