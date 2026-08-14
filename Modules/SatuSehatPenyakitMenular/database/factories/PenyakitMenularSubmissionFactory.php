<?php

namespace Modules\SatuSehatPenyakitMenular\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SatuSehatPenyakitMenular\Models\PenyakitMenularSubmission;

class PenyakitMenularSubmissionFactory extends Factory
{
    protected $model = PenyakitMenularSubmission::class;

    public function definition(): array
    {
        return [
            'encounter_local_id' => fake()->numberBetween(1, 10000),
            'use_case' => fake()->randomElement(['tuberkulosis', 'hiv', 'rabies', 'anthrax', 'smpk']),
            'resource_type' => 'Bundle',
            'payload' => ['resourceType' => 'Bundle'],
            'status' => 'pending',
        ];
    }
}
