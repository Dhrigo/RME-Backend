<?php

namespace Modules\GeneralMedicalDepartment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;

class MedicalDepartmentFactory extends Factory
{
    protected $model = MedicalDepartment::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
