<?php

namespace Modules\SatuSehatSpesialistik\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SatuSehatSpesialistik\Models\SpesialistikSubmission;

class SpesialistikSubmissionFactory extends Factory
{
    protected $model = SpesialistikSubmission::class;

    public function definition(): array
    {
        return [
            'encounter_local_id' => fake()->numberBetween(1, 10000),
            'use_case' => fake()->randomElement(['gigi', 'mata', 'telinga', 'geriatri', 'ubm']),
            'resource_type' => 'Bundle',
            'payload' => ['resourceType' => 'Bundle'],
            'status' => 'pending',
        ];
    }
}
