<?php

namespace Modules\MedicalRecordBaepInterventionProtocol\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;

class BaepInterventionProtocolFactory extends Factory
{
    protected $model = BaepInterventionProtocol::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'performed_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'indication' => fake()->sentence(6),
            'stimulation_ear' => fake()->randomElement(['left','right','bilateral']),
            'click_rate_hz' => fake()->randomFloat(2,10,30),
            'stimulus_intensity_db' => fake()->numberBetween(60,90),
            'wave_i_latency_ms' => fake()->randomFloat(2,1,2),
            'wave_iii_latency_ms' => fake()->randomFloat(2,3,4),
            'wave_v_latency_ms' => fake()->randomFloat(2,5,6),
            'interpretation' => null,
            'status' => 'in_progress',
            'performed_at' => now(),
        ];
    }
}
