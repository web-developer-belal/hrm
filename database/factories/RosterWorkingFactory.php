<?php

namespace Database\Factories;

use App\Models\Roster;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RosterWorkingFactory extends Factory
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
            'type' => $this->faker->randomElement(['off', 'working', 'holiday']),
            'day' => $this->faker->randomElement([
                'sunday','monday','tuesday','wednesday',
                'thursday','friday','saturday'
            ]),
        ];
    }
}
