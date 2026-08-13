<?php

namespace Modules\MedicalRecordFamilyMedicalHistory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordFamilyMedicalHistory\Models\FamilyMedicalHistory;

class FamilyMedicalHistoryFactory extends Factory
{
    protected $model = FamilyMedicalHistory::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'created_by' => null,
            'relation' => fake()->randomElement(['father','mother','sibling','grandparent']),
            'condition' => fake()->randomElement(['diabetes','hypertension','asthma','cancer','heart_disease']),
            'diagnosed_age' => fake()->numberBetween(20,70),
            'notes' => null,
        ];
    }
}
