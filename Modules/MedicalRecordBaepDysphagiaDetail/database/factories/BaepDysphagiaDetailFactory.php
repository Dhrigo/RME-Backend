<?php

namespace Modules\MedicalRecordBaepDysphagiaDetail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBaepDysphagiaDetail\Models\BaepDysphagiaDetail;

class BaepDysphagiaDetailFactory extends Factory
{
    protected $model = BaepDysphagiaDetail::class;

    public function definition(): array
    {
        return [
            'baep_protocol_id' => \Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol::factory(),
            'swallowing_test_used' => 'GUSS',
            'severity_level' => fake()->randomElement(['none','mild','moderate','severe']),
            'aspiration_risk' => fake()->boolean(),
            'diet_texture_recommendation' => fake()->randomElement(['regular','minced','pureed','liquid_thickened']),
        ];
    }
}
