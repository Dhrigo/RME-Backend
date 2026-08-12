<?php

namespace Modules\GeneralDiagnosisCode\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;

class DiagnosisCodeFactory extends Factory
{
    protected $model = DiagnosisCode::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('?##.#'),
            'name' => fake()->sentence(3),
            'is_active' => true,
        ];
    }
}
