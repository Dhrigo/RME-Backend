<?php

namespace Modules\MedicalRecordGynecologyHistory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordGynecologyHistory\Models\GynecologyHistory;

class GynecologyHistoryFactory extends Factory
{
    protected $model = GynecologyHistory::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'created_by' => null,
            'menarche_age' => fake()->numberBetween(10,16),
            'menstrual_cycle_pattern' => fake()->randomElement(['regular','irregular']),
            'contraception_history' => null,
            'gynecological_surgery_history' => null,
            'notes' => null,
        ];
    }
}
