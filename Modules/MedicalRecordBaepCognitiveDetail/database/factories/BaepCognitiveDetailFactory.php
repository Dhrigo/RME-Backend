<?php

namespace Modules\MedicalRecordBaepCognitiveDetail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBaepCognitiveDetail\Models\BaepCognitiveDetail;

class BaepCognitiveDetailFactory extends Factory
{
    protected $model = BaepCognitiveDetail::class;

    public function definition(): array
    {
        return [
            'baep_protocol_id' => \Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol::factory(),
            'scale_used' => 'MOCA',
            'score' => fake()->numberBetween(10,30),
            'domains_affected' => fake()->randomElement(['memory','attention','executive_function','language']),
        ];
    }
}
