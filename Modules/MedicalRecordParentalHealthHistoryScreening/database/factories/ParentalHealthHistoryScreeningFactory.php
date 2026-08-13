<?php

namespace Modules\MedicalRecordParentalHealthHistoryScreening\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordParentalHealthHistoryScreening\Models\ParentalHealthHistoryScreening;

class ParentalHealthHistoryScreeningFactory extends Factory
{
    protected $model = ParentalHealthHistoryScreening::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'screened_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'father_health_conditions' => null,
            'mother_health_conditions' => null,
            'consanguinity' => fake()->boolean(),
            'genetic_disorder_history' => null,
            'screened_at' => now(),
        ];
    }
}
