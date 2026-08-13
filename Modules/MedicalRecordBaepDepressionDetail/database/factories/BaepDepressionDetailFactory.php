<?php

namespace Modules\MedicalRecordBaepDepressionDetail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBaepDepressionDetail\Models\BaepDepressionDetail;

class BaepDepressionDetailFactory extends Factory
{
    protected $model = BaepDepressionDetail::class;

    public function definition(): array
    {
        return [
            'baep_protocol_id' => \Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol::factory(),
            'scale_used' => 'HDRS',
            'score' => fake()->numberBetween(0,52),
            'severity_level' => fake()->randomElement(['minimal','mild','moderate','severe']),
            'symptoms_observed' => null,
        ];
    }
}
