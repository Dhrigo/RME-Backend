<?php

namespace Modules\MedicalRecordIcd10CauseOfDeathCode\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordIcd10CauseOfDeathCode\Models\Icd10CauseOfDeathCode;

class Icd10CauseOfDeathCodeFactory extends Factory
{
    protected $model = Icd10CauseOfDeathCode::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper(fake()->bothify('??##')),
            'description' => fake()->words(3, true),
            'category' => fake()->words(3, true),
            'is_active' => true,
        ];
    }
}
