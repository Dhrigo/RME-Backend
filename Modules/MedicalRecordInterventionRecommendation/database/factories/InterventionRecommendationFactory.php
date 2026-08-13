<?php

namespace Modules\MedicalRecordInterventionRecommendation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordInterventionRecommendation\Models\InterventionRecommendation;

class InterventionRecommendationFactory extends Factory
{
    protected $model = InterventionRecommendation::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'source' => fake()->words(3, true),
            'recommendation' => fake()->sentence(),
            'priority' => fake()->words(3, true),
            'recommended_by' => Employee::factory(),
            'recommended_at' => now(),
            'status' => 'open',
        ];
    }
}
