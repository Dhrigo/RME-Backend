<?php

namespace Modules\MedicalRecordExaminationType\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordExaminationType\Models\ExaminationType;

class ExaminationTypeFactory extends Factory
{
    protected $model = ExaminationType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'category' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
