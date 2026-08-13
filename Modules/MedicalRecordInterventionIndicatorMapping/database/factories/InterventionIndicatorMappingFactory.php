<?php

namespace Modules\MedicalRecordInterventionIndicatorMapping\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordInterventionIndicatorMapping\Models\InterventionIndicatorMapping;

class InterventionIndicatorMappingFactory extends Factory
{
    protected $model = InterventionIndicatorMapping::class;

    public function definition(): array
    {
        return [
            'intervention_code' => 'INT-' . $this->faker->unique()->randomNumber(4),
            'intervention_name' => $this->faker->words(3, true),
            'indicator_code' => 'IND-' . $this->faker->unique()->randomNumber(4),
            'indicator_name' => $this->faker->words(3, true),
            'evaluation_criteria' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }
}
