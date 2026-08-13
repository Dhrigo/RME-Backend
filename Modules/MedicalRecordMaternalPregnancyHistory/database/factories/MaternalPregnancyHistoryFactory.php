<?php

namespace Modules\MedicalRecordMaternalPregnancyHistory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordMaternalPregnancyHistory\Models\MaternalPregnancyHistory;

class MaternalPregnancyHistoryFactory extends Factory
{
    protected $model = MaternalPregnancyHistory::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'created_by' => null,
            'gravida' => fake()->numberBetween(1,6),
            'para' => fake()->numberBetween(0,5),
            'abortus' => fake()->numberBetween(0,2),
            'pregnancy_complications' => null,
            'delivery_method_history' => null,
        ];
    }
}
