<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word . ' Department',
            'branch_id' => Branch::factory(), // creates branch if not provided
            'description' => $this->faker->optional()->sentence,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    public function active()
    {
        return $this->state(fn () => ['status' => 'active']);
    }

    public function inactive()
    {
        return $this->state(fn () => ['status' => 'inactive']);
    }
}
