<?php

namespace Modules\SatuSehat\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;

class SatuSehatStagingSubmissionFactory extends Factory
{
    protected $model = SatuSehatStagingSubmission::class;

    public function definition(): array
    {
        return [
            'resource_type' => 'Encounter',
            'satusehat_id' => null,
            'source_type' => 'Modules\\Pendaftaran\\Models\\Visit',
            'source_id' => fake()->numberBetween(1, 100000),
            'payload' => ['resourceType' => 'Encounter'],
            'status' => 'pending',
            'attempts' => 0,
            'last_error' => null,
            'sent_at' => null,
        ];
    }
}
