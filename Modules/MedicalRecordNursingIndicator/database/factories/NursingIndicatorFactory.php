<?php

namespace Modules\MedicalRecordNursingIndicator\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordNursingIndicatorType\Models\NursingIndicatorType;
use Modules\MedicalRecordNursingIndicator\Models\NursingIndicator;

class NursingIndicatorFactory extends Factory
{
    protected $model = NursingIndicator::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper(fake()->bothify('??##')),
            'name' => fake()->words(2, true),
            'nursing_indicator_type_id' => NursingIndicatorType::factory(),
            'unit' => fake()->words(3, true),
            'target_value' => fake()->words(3, true),
            'is_active' => true,
        ];
    }
}
