<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company . ' Branch',
            'contact' => $this->faker->optional()->phoneNumber,
            'address' => $this->faker->optional()->address,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
