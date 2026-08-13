<?php

namespace Modules\MedicalRecordTreatmentHistory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordTreatmentHistory\Models\TreatmentHistory;

class TreatmentHistoryFactory extends Factory
{
    protected $model = TreatmentHistory::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'created_by' => null,
            'treatment_description' => fake()->sentence(8),
            'facility_name' => fake()->company(),
            'treatment_date' => null,
            'outcome' => fake()->randomElement(['improved','unchanged','worsened']),
        ];
    }
}
