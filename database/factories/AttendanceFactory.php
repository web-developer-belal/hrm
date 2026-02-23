<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\Roster;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
    {
        $date = $this->faker->date();

        return [
            'branch_id' => Branch::factory(),
            'employee_id' => Employee::factory(),
            'roster_id' => Roster::factory(),
            'date' => $date,
            'shift_start_time' => '09:00:00',
            'shift_end_time' => '17:00:00',
            'clock_in' => null,
            'clock_out' => null,
            'late_minutes' => 0,
            'overtime_minutes' => 0,
            'early_exit_minutes' => 0,
            'status' => $this->faker->randomElement([
                'late','present','absent','leave','holiday','offday'
            ]),
            'remarks' => $this->faker->optional()->sentence,
            'is_manually_edited' => false,
            'edited_by' => null,
            'edited_at' => null,
        ];
    }
}
