<?php

namespace Modules\MedicalRecordBaepSensoryDetail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBaepSensoryDetail\Models\BaepSensoryDetail;

class BaepSensoryDetailFactory extends Factory
{
    protected $model = BaepSensoryDetail::class;

    public function definition(): array
    {
        return [
            'baep_protocol_id' => \Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol::factory(),
            'sensory_modality' => fake()->randomElement(['touch','pain','vibration','proprioception']),
            'sensory_score' => fake()->numberBetween(0,2),
            'affected_region' => fake()->words(2,true),
        ];
    }
}
