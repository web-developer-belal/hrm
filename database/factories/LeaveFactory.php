<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
    {
        $from = $this->faker->dateTimeBetween('-1 month', 'now');
        $to = (clone $from)->modify('+2 days');

        return [
            'branch_id' => Branch::factory(),
            'employee_id' => Employee::factory(),
            'leave_type_id' => LeaveType::factory(),
            'from_date' => $from->format('Y-m-d'),
            'to_date' => $to->format('Y-m-d'),
            'total_days' => 3,
            'descriptions' => $this->faker->optional()->sentence,
            'status' => $this->faker->randomElement(['pending','approved','rejected']),
            'confirmed_by' => null,
            'approved_by' => null,
        ];
    }
}
