<?php

namespace Modules\MedicalRecordIcd9CmCode\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordIcd9CmCode\Models\Icd9CmCode;

class Icd9CmCodeFactory extends Factory
{
    protected $model = Icd9CmCode::class;

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
