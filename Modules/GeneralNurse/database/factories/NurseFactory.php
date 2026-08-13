<?php

namespace Modules\GeneralNurse\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralNurse\Models\Nurse;
use Modules\GeneralEmployee\Models\Employee;

class NurseFactory extends Factory
{
    protected $model = Nurse::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'nurse_license_number' => $this->faker->numerify('NURSE-##########'),
            'is_active' => true,
        ];
    }
}
