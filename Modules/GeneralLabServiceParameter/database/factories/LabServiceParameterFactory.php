<?php

namespace Modules\GeneralLabServiceParameter\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralLabServiceGroup\Models\LabServiceGroup;
use Modules\GeneralLabServiceParameter\Models\LabServiceParameter;

class LabServiceParameterFactory extends Factory
{
    protected $model = LabServiceParameter::class;

    public function definition(): array
    {
        return [
            'lab_service_group_id' => LabServiceGroup::factory(),
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'unit' => fake()->randomElement(['g/dL', 'mg/dL', '%', 'mmol/L', 'ribu/uL']),
            'is_active' => true,
        ];
    }
}
