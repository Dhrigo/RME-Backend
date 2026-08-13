<?php

namespace Modules\PendaftaranPatientPurpose\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranPatientPurpose\Models\PatientPurpose;

class PatientPurposeFactory extends Factory
{
    protected $model = PatientPurpose::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}