<?php

namespace Modules\MedicalRecordBaepStimulationProtocolDetail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBaepStimulationProtocolDetail\Models\BaepStimulationProtocolDetail;

class BaepStimulationProtocolDetailFactory extends Factory
{
    protected $model = BaepStimulationProtocolDetail::class;

    public function definition(): array
    {
        return [
            'baep_protocol_id' => \Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol::factory(),
            'stimulation_site' => fake()->randomElement(['temporal','occipital','vertex']),
            'stimulation_frequency_hz' => fake()->randomFloat(2,1,50),
            'stimulation_duration_minutes' => fake()->numberBetween(10,30),
            'intensity_ma' => fake()->randomFloat(2,0.5,4),
            'number_of_sessions' => fake()->numberBetween(1,20),
        ];
    }
}
