<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Roster;
use App\Models\Shift;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RosterEmployee>
 */
class RosterEmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'roster_id' => Roster::factory(),
            'employee_id' => Employee::factory(),
            'shift_id' => Shift::factory(),
        ];
    }
}
