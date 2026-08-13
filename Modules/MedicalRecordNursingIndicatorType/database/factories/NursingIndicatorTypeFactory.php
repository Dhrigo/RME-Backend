<?php

namespace Modules\MedicalRecordNursingIndicatorType\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordNursingIndicatorType\Models\NursingIndicatorType;

class NursingIndicatorTypeFactory extends Factory
{
    protected $model = NursingIndicatorType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
