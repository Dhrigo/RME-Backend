<?php

namespace Modules\MedicalRecordFunctionalStatusAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordFunctionalStatusAssessment\Models\FunctionalStatusAssessment;

class FunctionalStatusAssessmentFactory extends Factory
{
    protected $model = FunctionalStatusAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'assessed_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'bathing_status' => 'independent',
            'dressing_status' => 'independent',
            'toileting_status' => 'independent',
            'transferring_status' => 'independent',
            'feeding_status' => 'independent',
            'total_score' => fake()->numberBetween(0,5),
            'assessed_at' => now(),
        ];
    }
}
