<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'first_name'   => $this->faker->firstName(),
            'last_name'    => $this->faker->lastName(),
            'phone_number' => $this->faker->phoneNumber(),
            'address'      => $this->faker->address(),
            'role'         => $this->faker->randomElement(['employee', 'admin', 'hr']),
            'email'        => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'     => static::$password ??= Hash::make('1234'), 
            'status'       => $this->faker->randomElement(['active', 'inactive']),
            'photo'        => null,
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function active(): static
    {
        return $this->state(fn () => [
            'status' => 'active',
        ]);
    }

    public function employee(): static
    {
        return $this->state(fn () => [
            'role' => 'employee',
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn () => [
            'role' => 'admin',
        ]);
    }
}
