<?php

namespace Modules\MedicalRecordObstetricHistory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordObstetricHistory\Models\ObstetricHistory;

class ObstetricHistoryFactory extends Factory
{
    protected $model = ObstetricHistory::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'created_by' => null,
            'pregnancy_number' => fake()->numberBetween(1,6),
            'delivery_date' => null,
            'delivery_method' => fake()->randomElement(['normal','cesarean','vacuum','forceps']),
            'birth_weight_grams' => fake()->numberBetween(2000,4000),
            'complications' => null,
            'outcome' => fake()->randomElement(['live_birth','stillbirth']),
        ];
    }
}
