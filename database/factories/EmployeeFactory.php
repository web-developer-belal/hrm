<?php
namespace Database\Factories;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Shift;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        static $employeeNumber = 1;

        return [
            'photo'                    => null,

            'first_name'               => $this->faker->firstName(),
            'last_name'                => $this->faker->lastName(),

            'email'                    => 'employee' . $employeeNumber++ . '@gmail.com',

            'password'                 => Hash::make('1234'),

            'date_of_birth'            => $this->faker->date('Y-m-d', '2005-01-01'),

            'gender'                   => $this->faker->randomElement(['male', 'female', 'other']),

            'contact_number'           => $this->faker->numerify('##########'),
            'alternative_phone_number' => $this->faker->optional()->numerify('##########'),

            'local_address'            => $this->faker->address(),
            'permanent_address'        => $this->faker->address(),

            'description'              => $this->faker->sentence(),

            'employee_code'            => 'EMP' . strtoupper(Str::random(5)),

            'branch_id'                => Branch::factory(),
            'department_id'            => Department::factory(),
            'designation_id'           => Designation::factory(),
            'shift_id'                 => Shift::factory(),

            'joining_date'             => $this->faker->date('Y-m-d'),

            'status'                   => $this->faker->randomElement([0, 1]),

            'workspace'                => $this->faker->randomElement(['Onsite', 'Remote', 'Hybrid']),

            'supervisor_id'            => null,

            'bank_name'                => $this->faker->company(),
            'routing_number'           => $this->faker->numerify('#########'),
            'account_holder_name'      => $this->faker->name(),
            'bank_account_type'        => $this->faker->randomElement(['savings', 'current', 'other']),
            'account_number'           => $this->faker->bankAccountNumber(),
            'bank_notes'               => $this->faker->sentence(),
            'resume'                   => null,
            'offer_letter'             => null,
            'joining_letter'           => null,
            'contract_agreement'       => null,
            'Id_proof'                 => null,
        ];
    }
}
