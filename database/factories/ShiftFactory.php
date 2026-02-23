<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shift>
 */
class ShiftFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->time('H:i:s');
        $end = date('H:i:s', strtotime($start . ' +8 hours'));

        return [
            'name' => ucfirst($this->faker->word) . ' Shift',
            'start_time' => $start,
            'end_time' => $end,
            'working_hours' => 8.00,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    public function active()
    {
        return $this->state(fn () => ['status' => 'active']);
    }
}
