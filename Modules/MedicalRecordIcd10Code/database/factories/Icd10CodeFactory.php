<?php

namespace Modules\MedicalRecordIcd10Code\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordIcd10Code\Models\Icd10Code;

class Icd10CodeFactory extends Factory
{
    protected $model = Icd10Code::class;

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
