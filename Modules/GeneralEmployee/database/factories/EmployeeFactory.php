<?php

namespace Modules\GeneralEmployee\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'user_id' => null,
            'employee_number' => fake()->unique()->numerify('##################'),
            'name' => fake()->name(),
            'nickname' => fake()->firstName(),
            'title_prefix' => null,
            'title_suffix' => null,
            'birth_place' => fake()->city(),
            'birth_date' => fake()->date(),
            'religion_id' => null,
            'gender_id' => null,
            'profession_id' => null,
            'smf_id' => null,
            'address' => fake()->address(),
            'rt' => fake()->numerify('##'),
            'rw' => fake()->numerify('##'),
            'postal_code' => fake()->postcode(),
            'region_code' => null,
            'is_non_employee' => false,
            'is_active' => true,
        ];
    }
}
