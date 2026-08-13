<?php

namespace Modules\MedicalRecordFamilyPlanningObstetrics\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordFamilyPlanningObstetrics\Models\FamilyPlanningObstetrics;

class FamilyPlanningObstetricsFactory extends Factory
{
    protected $model = FamilyPlanningObstetrics::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'patient_id' => 1,
            'contraceptive_method' => $this->faker->randomElement(['IUD', 'Implant', 'Injection', 'Pill']),
            'installation_date' => now()->toDateString(),
            'removal_date' => null,
            'side_effects' => $this->faker->sentence(),
            'action_taken' => $this->faker->sentence(),
            'next_visit_date' => now()->addMonths(3)->toDateString(),
        ];
    }
}
