<?php

namespace Modules\LayananTreatmentProtocolStep\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananTreatmentProtocol\Models\TreatmentProtocol;
use Modules\LayananTreatmentProtocolStep\Models\TreatmentProtocolStep;

class TreatmentProtocolStepFactory extends Factory
{
    protected $model = TreatmentProtocolStep::class;

    public function definition(): array
    {
        return [
            'treatment_protocol_id' => TreatmentProtocol::factory(),
            'sequence' => fake()->numberBetween(1, 10),
            'instruction' => fake()->words(3, true),
            'scheduled_at' => now(),
            'status' => 'pending',
        ];
    }
}
