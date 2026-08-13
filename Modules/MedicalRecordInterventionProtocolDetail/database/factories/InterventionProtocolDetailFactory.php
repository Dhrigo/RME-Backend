<?php

namespace Modules\MedicalRecordInterventionProtocolDetail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordInterventionProtocolDetail\Models\InterventionProtocolDetail;

class InterventionProtocolDetailFactory extends Factory
{
    protected $model = InterventionProtocolDetail::class;

    public function definition(): array
    {
        return [
            'protocol_id' => \Modules\MedicalRecordInterventionProtocol\Models\InterventionProtocol::factory(),
            'performed_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'step_number' => fake()->numberBetween(1,10),
            'step_description' => fake()->sentence(6),
            'result_notes' => null,
            'performed_at' => now(),
        ];
    }
}
