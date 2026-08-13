<?php

namespace Modules\MedicalRecordIllnessProgressionHistory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordIllnessProgressionHistory\Models\IllnessProgressionHistory;

class IllnessProgressionHistoryFactory extends Factory
{
    protected $model = IllnessProgressionHistory::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'created_by' => null,
            'symptom_onset_date' => null,
            'progression_description' => fake()->sentence(10),
            'prior_treatment' => null,
        ];
    }
}
