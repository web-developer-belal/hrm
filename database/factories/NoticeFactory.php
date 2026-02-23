<?php
namespace Database\Factories;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notice>
 */
class NoticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'branch_id'     => $this->faker->boolean(70) ? Branch::factory() : null,
            'department_id' => $this->faker->boolean(70) ? Department::factory() : null,
            'title'         => $this->faker->sentence(6),
            'description'   => $this->faker->paragraph,
            'attachments'   => [
                'file_' . $this->faker->numberBetween(1, 5) . '.pdf',
            ],
            'status'        => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    public function active()
    {
        return $this->state(fn() => ['status' => 'active']);
    }
}
