<?php

namespace Modules\MedicalRecordPediatricStatus\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordPediatricStatus\Models\PediatricStatus;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;

class PediatricStatusFactory extends Factory
{
    protected $model = PediatricStatus::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'birth_weight_grams' => $this->faker->numberBetween(2500, 4000),
            'birth_length_cm' => $this->faker->randomFloat(2, 45, 55),
            'head_circumference_cm' => $this->faker->randomFloat(2, 30, 40),
            'gestational_age_weeks' => $this->faker->numberBetween(37, 42),
            'immunization_status' => 'Complete for age',
            'developmental_milestones' => 'Normal growth and development',
            'notes' => $this->faker->sentence(),
            'recorded_at' => now(),
        ];
    }
}
