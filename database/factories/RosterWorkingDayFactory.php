<?php
namespace Database\Factories;

use App\Models\Roster;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RosterWorkingDay>
 */
class RosterWorkingDayFactory extends Factory
{
    public function definition(): array
    {
        return [
            'roster_id' => Roster::factory(),

            'type'      => $this->faker->randomElement([
                'working',
                'off',
                'holiday',
            ]),

            'day'       => $this->faker->randomElement([
                'sunday',
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
                'saturday',
            ]),
        ];
    }

    // Optional states (clean & useful)
    public function working()
    {
        return $this->state(fn() => ['type' => 'working']);
    }

    public function off()
    {
        return $this->state(fn() => ['type' => 'off']);
    }

    public function holiday()
    {
        return $this->state(fn() => ['type' => 'holiday']);
    }
}
