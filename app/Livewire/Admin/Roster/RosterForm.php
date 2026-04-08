<?php
namespace App\Livewire\Admin\Roster;

use App\Http\Requests\RosterRequest;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\BranchGroup;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Roster;
use App\Models\Shift;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public $group;
    public $group_options = [];
    public $group_search;

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
        $this->loadGroups();
        $this->loadShiftIdOptions();

        if ($roster) {
            $this->isEditMode = true;
            $this->roster     = Roster::findOrFail($roster);

            $this->group         = $this->roster->branch?->branch_group_id;
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
            $this->loadBranchIdOptions();
            $this->loadDepartmentIdOptions();
            $this->loadEmployeesOptions();

            return;
        }

        $this->loadBranchIdOptions();
    }

    public function loadGroups()
    {
        $this->group_options = BranchGroup::query()
            ->when($this->group_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->group_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedGroupSearch(): void
    {
        $this->loadGroups();
    }

    public function updatedGroup(): void
    {
        $this->loadBranchIdOptions();

        if (! $this->group) {
            $this->branch_id = $this->isEditMode ? null : [];
            $this->updatedBranchId();
            return;
        }

        if ($this->isEditMode) {
            $this->branch_id = array_key_first($this->branch_id_options) ?? null;
        } else {
            $this->branch_id = array_keys($this->branch_id_options);
        }

        $this->updatedBranchId();
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
            ->when($this->group, fn($q) =>
                $q->where('branch_group_id', $this->group)
            )
            ->when($this->branch_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branch_id_search . '%')
            )
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
        $this->department_id_search  = '';
        $this->department_id_options = [];
        $this->employees_search      = '';
        $this->employees_options     = [];

        $this->loadDepartmentIdOptions();
    }

    protected function loadDepartmentIdOptions()
    {
        $branchIds = $this->selectedBranchIds();

        if ($branchIds === []) {
            $this->department_id_options = [];
            return;
        }

        $this->department_id_options = Department::query()
            ->whereIn('branch_id', $branchIds)
            ->where('status', 'active')
            ->when($this->department_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->department_id_search . '%')
            )
            ->orderBy('name')
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
        $this->employees_search  = '';
        $this->employees_options = [];

        $this->loadEmployeesOptions();
    }

    protected function loadEmployeesOptions()
    {
        $branchIds     = $this->selectedBranchIds();
        $departmentIds = $this->selectedDepartmentIds();

        if ($branchIds === [] || $departmentIds === []) {
            $this->employees_options = [];
            return;
        }

        $this->employees_options = Employee::where('status', 1)
            ->whereIn('branch_id', $branchIds)
            ->whereIn('department_id', $departmentIds)
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

    protected function selectedBranchIds(): array
    {
        return collect((array) $this->branch_id)
            ->filter(fn($id) => filled($id))
            ->map(fn($id) => (int) $id)
            ->unique()
            ->values()
            ->all();
    }

    protected function selectedDepartmentIds(): array
    {
        return collect((array) $this->department_id)
            ->filter(fn($id) => filled($id))
            ->map(fn($id) => (int) $id)
            ->unique()
            ->values()
            ->all();
    }

    protected function selectedEmployeeIds(): array
    {
        return collect((array) $this->employees)
            ->filter(fn($id) => filled($id))
            ->map(fn($id) => (int) $id)
            ->unique()
            ->values()
            ->all();
    }

    protected function validationRules(): array
    {
        $rules = (new RosterRequest())->rules();

        $rules['working_days']    = 'required|array|min:1';
        $rules['weekly_off_days'] = 'required|array';
        $rules['employees']       = 'required|array|min:1';
        $rules['employees.*']     = 'required|exists:employees,id';

        if ($this->isEditMode) {
            $rules['branch_id']     = 'required|exists:branches,id';
            $rules['department_id'] = 'required|exists:departments,id';

            return $rules;
        }

        $rules['branch_id']       = 'required|array|min:1';
        $rules['branch_id.*']     = 'required|exists:branches,id';
        $rules['department_id']   = 'required|array|min:1';
        $rules['department_id.*'] = 'required|exists:departments,id';

        return $rules;
    }

    public function save()
    {

        $allDays = array_keys($this->working_days_options);

        $this->weekly_off_days = array_values(
            array_diff($allDays, $this->working_days ?? [])
        );
        $data = $this->validate(
            $this->validationRules(),
            (new RosterRequest())->messages()
        );

        // $payload = collect($data)->except(['employees'])->all();
        $payload = collect($data)
            ->except(['employees', 'branch_id', 'department_id'])
            ->all();
        $createdCount = 0;
        // \Log::info("Roster Data". $payload);
        // dd($payload );

        DB::transaction(function () use ($data, $payload, &$createdCount) {

            if ($this->isEditMode) {
                $this->roster->update($payload);
                return;
            }

            $branchIds     = $this->selectedBranchIds();
            $departmentIds = $this->selectedDepartmentIds();
            $employeeIds   = $this->selectedEmployeeIds();

            $departments = Department::query()
                ->whereIn('id', $departmentIds)
                ->whereIn('branch_id', $branchIds)
                ->get(['id', 'branch_id']);

            if ($departments->isEmpty()) {
                $this->addError('department_id', 'Selected departments do not belong to the selected branches.');
                return;
            }

            $employees = Employee::query()
                ->where('status', 1)
                ->whereIn('id', $employeeIds)
                ->whereIn('branch_id', $branchIds)
                ->whereIn('department_id', $departments->pluck('id')->all())
                ->get(['id', 'branch_id', 'department_id']);

            if ($employees->isEmpty()) {
                $this->addError('employees', 'Select at least one employee from the selected branches and departments.');
                return;
            }

            $employeesByBucket = $employees->groupBy(
                fn($employee) => $employee->branch_id . '-' . $employee->department_id
            );

            $createdRosters = collect();

            foreach ($departments as $department) {
                $bucketKey           = $department->branch_id . '-' . $department->id;
                $departmentEmployees = $employeesByBucket->get($bucketKey, collect());

                if ($departmentEmployees->isEmpty()) {
                    continue;
                }

                $rosterData                  = $payload;
                $rosterData['branch_id']     = (int) $department->branch_id;
                $rosterData['department_id'] = (int) $department->id;
                try {
                    $roster = Roster::create($rosterData);
                } catch (\Throwable $e) {
                    Log::error('Roster create failed', [
                        'data'  => $rosterData,
                        'error' => $e->getMessage(),
                    ]);
                    continue;
                }

                // $roster = Roster::create($rosterData);
                $roster->load('shift');
                if (! $roster->shift) {
                    Log::error('Shift not found', ['shift_id' => $roster->shift_id]);
                    continue;
                }

                $syncData = [];

                foreach ($departmentEmployees as $employee) {
                    $syncData[$employee->id] = [
                        'shift_id' => $this->shift_id,
                    ];
                }

                $roster->employees()->sync($syncData);

                $period = CarbonPeriod::create($this->start_date, $this->end_date);

                foreach ($period as $date) {
                    $dayName = strtolower($date->format('l'));

                    $status = in_array($dayName, $this->working_days)
                        ? null
                        : 'offday';

                    foreach ($departmentEmployees as $employee) {
                        Attendance::insertOrIgnore([
                            'branch_id'        => $department->branch_id,
                            'employee_id'      => $employee->id,
                            'roster_id'        => $roster->id,
                            'date'             => $date->toDateString(),
                            'shift_start_time' => $roster->shift->start_time,
                            'shift_end_time'   => $roster->shift->end_time,
                            'status'           => $status,
                            'created_at'       => now(),
                            'updated_at'       => now(),
                        ]);
                    }
                }

                $createdRosters->push($roster);
            }

            $this->roster = $createdRosters->first();
            $createdCount = $createdRosters->count();
        });

        if (! $this->isEditMode && $createdCount === 0) {
            $this->addError('employees', 'No roster could be created from the selected branch, department, and employee combinations.');
            return;
        }

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
