<?php

namespace Modules\PegawaiEmployeeIdentityCard\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PegawaiEmployeeIdentityCard\Models\EmployeeIdentityCard;

class EmployeeIdentityCardFactory extends Factory
{
    protected $model = EmployeeIdentityCard::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'id_type' => fake()->randomElement(['KTP', 'SIM', 'Paspor']),
            'id_number' => fake()->unique()->numerify('################'),
            'issued_at' => fake()->date(),
        ];
    }
}
