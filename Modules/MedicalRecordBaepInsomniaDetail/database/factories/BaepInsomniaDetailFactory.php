<?php

namespace Modules\MedicalRecordBaepInsomniaDetail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBaepInsomniaDetail\Models\BaepInsomniaDetail;

class BaepInsomniaDetailFactory extends Factory
{
    protected $model = BaepInsomniaDetail::class;

    public function definition(): array
    {
        return [
            'baep_protocol_id' => \Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol::factory(),
            'scale_used' => 'ISI',
            'score' => fake()->numberBetween(0,28),
            'sleep_onset_latency_minutes' => fake()->numberBetween(5,90),
            'sleep_efficiency_percent' => fake()->numberBetween(40,95),
        ];
    }
}
