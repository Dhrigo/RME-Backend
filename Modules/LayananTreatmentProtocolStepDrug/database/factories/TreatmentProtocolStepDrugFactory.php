<?php

namespace Modules\LayananTreatmentProtocolStepDrug\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananTreatmentProtocolStep\Models\TreatmentProtocolStep;
use Modules\LayananTreatmentProtocolStepDrug\Models\TreatmentProtocolStepDrug;

class TreatmentProtocolStepDrugFactory extends Factory
{
    protected $model = TreatmentProtocolStepDrug::class;

    public function definition(): array
    {
        return [
            'treatment_protocol_step_id' => TreatmentProtocolStep::factory(),
            'drug_name' => fake()->words(2, true),
            'dosage' => fake()->words(3, true),
            'frequency' => fake()->words(3, true),
            'route' => fake()->words(3, true),
        ];
    }
}
