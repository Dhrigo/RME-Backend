<?php

namespace Modules\MedicalRecordAnamnesis\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordAnamnesis\Models\Anamnesis;

class AnamnesisFactory extends Factory
{
    protected $model = Anamnesis::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'present_illness_history' => fake()->sentence(),
            'past_medical_history' => fake()->sentence(),
            'family_medical_history' => fake()->sentence(),
            'allergy_history' => fake()->sentence(),
            'social_history' => fake()->sentence(),
            'recorded_by' => Employee::factory(),
            'recorded_at' => now(),
        ];
    }
}
