<?php

namespace Modules\SatuSehatKlaim\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SatuSehatKlaim\Models\KlaimSubmission;

class KlaimSubmissionFactory extends Factory
{
    protected $model = KlaimSubmission::class;

    public function definition(): array
    {
        return [
            'encounter_local_id' => fake()->numberBetween(1, 10000),
            'use_case' => fake()->randomElement([
                'swasta_primary_payor', 'swasta_secondary_payor', 'swasta_tpa', 'swasta_oop', 'bpjsk', 'rujukan_pasien',
            ]),
            'resource_type' => 'Bundle',
            'payload' => ['resourceType' => 'Bundle'],
            'status' => 'pending',
        ];
    }
}
