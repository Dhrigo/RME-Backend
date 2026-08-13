<?php

namespace Modules\MedicalRecordBaepMotorDetail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBaepMotorDetail\Models\BaepMotorDetail;

class BaepMotorDetailFactory extends Factory
{
    protected $model = BaepMotorDetail::class;

    public function definition(): array
    {
        return [
            'baep_protocol_id' => \Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol::factory(),
            'muscle_strength_score' => fake()->numberBetween(0,5),
            'spasticity_level' => fake()->randomElement(['0','1','1+','2','3','4']),
            'gait_status' => fake()->randomElement(['independent','assisted','wheelchair','bedbound']),
        ];
    }
}
