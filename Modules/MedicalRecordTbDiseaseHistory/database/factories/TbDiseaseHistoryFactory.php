<?php

namespace Modules\MedicalRecordTbDiseaseHistory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordTbDiseaseHistory\Models\TbDiseaseHistory;

class TbDiseaseHistoryFactory extends Factory
{
    protected $model = TbDiseaseHistory::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'created_by' => null,
            'previous_tb_treatment' => fake()->boolean(),
            'treatment_year' => fake()->numberBetween(2015,2025),
            'treatment_outcome' => fake()->randomElement(['cured','completed','failed','ongoing']),
            'tb_category' => fake()->randomElement(['new_case','relapse','failure']),
            'notes' => null,
        ];
    }
}
