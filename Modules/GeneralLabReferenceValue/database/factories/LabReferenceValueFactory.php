<?php

namespace Modules\GeneralLabReferenceValue\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralLabReferenceValue\Models\LabReferenceValue;
use Modules\GeneralLabServiceParameter\Models\LabServiceParameter;

class LabReferenceValueFactory extends Factory
{
    protected $model = LabReferenceValue::class;

    public function definition(): array
    {
        return [
            'lab_service_parameter_id' => LabServiceParameter::factory(),
            'gender' => fake()->randomElement(['male', 'female', 'all']),
            'min_age' => 0,
            'max_age' => 100,
            'min_value' => fake()->randomFloat(2, 1, 10),
            'max_value' => fake()->randomFloat(2, 11, 20),
            'unit' => 'g/dL',
            'note' => null,
            'is_active' => true,
        ];
    }
}
