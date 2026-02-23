<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveType>
 */
class LeaveTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'branch_id' => Branch::factory(),
            'name' => ucfirst($this->faker->unique()->word) . ' Leave',
            'annual_limit' => $this->faker->numberBetween(5, 30),
            'is_paid' => $this->faker->numberBetween(0,1),
        ];
    }
}
