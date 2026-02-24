<?php
namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Notice;
use App\Models\Roster;
use App\Models\RosterEmployee;
use App\Models\RosterWorkingDay;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1️⃣ Admin User
        $admin = User::factory()->admin()->active()->create([
            'email' => 'admin@gmail.com',
        ]);

        // 2️⃣ Branches
        $branches = Branch::factory()
            ->count(3)
            ->create();

        // 3️⃣ Departments (linked to branches)
        $departments = collect();
        foreach ($branches as $branch) {
            $departments = $departments->merge(
                Department::factory()
                    ->count(3)
                    ->create([
                        'branch_id' => $branch->id,
                    ])
            );
        }

        // 4️⃣ Designations (linked to departments)
        $designations = collect();
        foreach ($departments as $department) {
            $designations = $designations->merge(
                Designation::factory()
                    ->count(2)
                    ->create([
                        'department_id' => $department->id,
                    ])
            );
        }

        // 5️⃣ Shifts
        $shifts = Shift::factory()
            ->count(3)
            ->create();

        // 6️⃣ Employees (properly linked)
        $employees = Employee::factory()
            ->count(15)
            ->make()
            ->each(function ($employee) use ($branches, $departments, $designations, $shifts) {

                $branch      = $branches->random();
                $department  = $departments->where('branch_id', $branch->id)->random();
                $designation = $designations->where('department_id', $department->id)->random();

                $employee->branch_id      = $branch->id;
                $employee->department_id  = $department->id;
                $employee->designation_id = $designation->id;
                $employee->shift_id       = $shifts->random()->id;

                $employee->save();
            });

        // 7️⃣ Rosters
        $rosters = Roster::factory()
            ->count(5)
            ->make()
            ->each(function ($roster) use ($branches, $departments, $shifts) {

                $branch     = $branches->random();
                $department = $departments->where('branch_id', $branch->id)->random();

                $roster->branch_id     = $branch->id;
                $roster->department_id = $department->id;
                $roster->shift_id      = $shifts->random()->id;

                $roster->save();
            });

        // 8️⃣ Roster Working Days
        foreach ($rosters as $roster) {
            RosterWorkingDay::factory()
                ->count(7)
                ->create([
                    'roster_id' => $roster->id,
                ]);
        }

        // 9️⃣ Roster Employees
        foreach ($rosters as $roster) {
            $employees->random(5)->each(function ($employee) use ($roster, $shifts) {
                RosterEmployee::factory()->create([
                    'roster_id'   => $roster->id,
                    'employee_id' => $employee->id,
                    'shift_id'    => $shifts->random()->id,
                ]);
            });
        }

        // 🔟 Attendance
        // foreach ($employees as $employee) {
        //     Attendance::factory()
        //         ->count(5)
        //         ->create([
        //             'employee_id' => $employee->id,
        //             'branch_id'   => $employee->branch_id,
        //             'roster_id'   => $rosters->random()->id,
        //         ]);
        // }

        // 1️⃣1️⃣ Leave Types
        $leaveTypes = LeaveType::factory()
            ->count(3)
            ->create();

        // 1️⃣2️⃣ Leaves
        foreach ($employees as $employee) {
            Leave::factory()->create([
                'employee_id'   => $employee->id,
                'branch_id'     => $employee->branch_id,
                'leave_type_id' => $leaveTypes->random()->id,
            ]);
        }

        // 1️⃣3️⃣ Notices
        $notices = Notice::factory()
            ->count(5)
            ->create();

        // Mark some notices as read
        foreach ($notices as $notice) {
            $employees->random(5)->each(function ($employee) use ($notice) {
                $notice->readers()->attach($employee->id, [
                    'read_at' => now(),
                ]);
            });
        }
    }
}
