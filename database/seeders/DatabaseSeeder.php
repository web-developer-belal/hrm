<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $branches = [
            [
                'name' => 'Main Branch', 'address' => '123 Main St', 'contact' => '555-1234',
            ],
            [
                'name' => 'East Branch', 'address' => '456 East St', 'contact' => '555-5678',
            ],
            [
                'name' => 'West Branch', 'address' => '789 West St', 'contact' => '555-9012',

            ],
        ];
        foreach ($branches as $branch) {
            \App\Models\Branch::create($branch);
        }

        $departments = [
            ['name' => 'Human Resources', 'branch_id' => 1],
            ['name' => 'Finance', 'branch_id' => 1],
            ['name' => 'IT', 'branch_id' => 2],
            ['name' => 'Sales', 'branch_id' => 3],
        ];
        foreach ($departments as $department) {
            \App\Models\Department::create($department);
        }

        $shifts = [
            ['name' => 'Morning Shift', 'start_time' => '08:00:00', 'end_time' => '16:00:00'],
            ['name' => 'Evening Shift', 'start_time' => '16:00:00', 'end_time' => '00:00:00'],
            ['name' => 'Night Shift', 'start_time' => '00:00:00', 'end_time' => '08:00:00'],
        ];

        foreach ($shifts as $shift) {
            \App\Models\Shift::create($shift);
        }

        $designations = [
            ['name' => 'Manager', 'department_id' => 1],
            ['name' => 'Accountant', 'department_id' => 2],
            ['name' => 'Developer', 'department_id' => 3],
            ['name' => 'Sales Executive', 'department_id' => 4],
        ];

        foreach ($designations as $designation) {
            \App\Models\Designation::create($designation);
        }

        $employees = [
            [
                'first_name'     => 'John',
                'last_name'      => 'Doe',
                'date_of_birth'  => '1990-01-01',
                'gender'         => 'male',
                'contact_number' => '555-0001',
                'employee_code'  => 'EMP001',
                'branch_id'      => 1,
                'department_id'  => 1,
                'designation_id' => 1,
                'shift_id'       => 1,
                'joining_date'   => '2020-01-15',
            ],
            [
                'first_name'     => 'Jane',
                'last_name'      => 'Smith',
                'date_of_birth'  => '1992-02-02',
                'gender'         => 'female',
                'contact_number' => '555-0002',
                'employee_code'  => 'EMP002',
                'branch_id'      => 1,
                'department_id'  => 2,
                'designation_id' => 2,
                'shift_id'       => 2,
                'joining_date'   => '2021-03-20',
            ],
        ];
        foreach ($employees as $employee) {
            \App\Models\Employee::create($employee);
        }

        $rosters = [
            [
                'name'                => 'January Roster',
                'branch_id'           => 1,
                'department_id'       => 1,
                'shift_id'            => 1,
                'start_date'          => '2026-01-01',
                'end_date'            => '2026-01-31',
                'roster_employees'    => [1],
                'roster_working_days' => [
                    ['roster_id' => 1, 'type' => 'working', 'day' => 'sunday'],
                    ['roster_id' => 1, 'type' => 'working', 'day' => 'monday'],
                    ['roster_id' => 1, 'type' => 'working', 'day' => 'tuesday'],
                    ['roster_id' => 1, 'type' => 'working', 'day' => 'wednesday'],
                    ['roster_id' => 1, 'type' => 'working', 'day' => 'thursday'],
                    ['roster_id' => 1, 'type' => 'off', 'day' => 'friday'],
                    ['roster_id' => 1, 'type' => 'off', 'day' => 'saturday'],
                    ['roster_id' => 1, 'type' => 'off', 'day' => 'sunday'],
                ],
            ],
            [
                'name'                => 'February Roster',
                'branch_id'           => 1,
                'department_id'       => 2,
                'shift_id'            => 2,
                'start_date'          => '2026-02-01',
                'end_date'            => '2026-02-28',
                'roster_employees'    => [2],
                'roster_working_days' => [
                    ['roster_id' => 2, 'type' => 'working', 'day' => 'monday'],
                    ['roster_id' => 2, 'type' => 'working', 'day' => 'tuesday'],
                    ['roster_id' => 2, 'type' => 'working', 'day' => 'wednesday'],
                    ['roster_id' => 2, 'type' => 'working', 'day' => 'thursday'],
                    ['roster_id' => 2, 'type' => 'working', 'day' => 'friday'],
                    ['roster_id' => 2, 'type' => 'off', 'day' => 'saturday'],
                    ['roster_id' => 2, 'type' => 'off', 'day' => 'sunday'],
                ],
            ],
        ];
        foreach ($rosters as $roster) {
            DB::transaction(function () use ($roster) {
                $rosterEmployees = $roster['roster_employees'];
                $rosterWorkingDays = $roster['roster_working_days'];
                unset($roster['roster_employees'], $roster['roster_working_days']);

                $newRoster = \App\Models\Roster::create($roster);

                // Attach employees to roster
                foreach ($rosterEmployees as $employeeId) {
                    \App\Models\RosterEmployee::create([
                        'roster_id'   => $newRoster->id,
                        'employee_id' => $employeeId,
                        'date' => '2026-01-01',
                        'shift_id' => 1,
                    ]);
                }

                // Create working days
                foreach ($rosterWorkingDays as $workingDay) {
                    \App\Models\RosterWorkingDay::create($workingDay);
                }
            });
        }

         User::updateOrCreate([
            'first_name'=> 'Akbar',
            'last_name'=> 'Ali',
            'role'=> 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),

        ]);


    }
}
