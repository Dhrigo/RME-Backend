<?php

namespace Modules\MedicalRecordObstetrics\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordObstetrics\Models\Obstetrics;

class ObstetricsFactory extends Factory
{
    protected $model = Obstetrics::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'patient_id' => 1,
            'gravida' => $this->faker->numberBetween(1, 4),
            'para' => $this->faker->numberBetween(0, 3),
            'abortus' => $this->faker->numberBetween(0, 1),
            'gestational_age_weeks' => 38.5,
            'fundal_height_cm' => 32.0,
            'fetal_heart_rate' => 140,
            'fetal_presentation' => 'Cephalic',
            'estimated_fetal_weight' => 3100,
            'notes' => $this->faker->sentence(),
            'examined_at' => now(),
        ];
    }
}
