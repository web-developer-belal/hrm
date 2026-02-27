<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Shift;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Roster>
 */
class RosterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 month', 'now');
        $end = (clone $start)->modify('+7 days');

        return [
            'name' => 'Roster ' . $this->faker->unique()->numberBetween(1, 999),
            'branch_id' => Branch::factory(),
            'department_id' => Department::factory(),
            'shift_id' => Shift::factory(),
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'working_days' => json_encode(['monday','tuesday','wednesday','thursday','friday']),
            'weekly_off_days' => json_encode(['saturday','sunday']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
