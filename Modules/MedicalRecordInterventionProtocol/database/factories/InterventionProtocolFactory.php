<?php

namespace Modules\MedicalRecordInterventionProtocol\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordInterventionProtocol\Models\InterventionProtocol;

class InterventionProtocolFactory extends Factory
{
    protected $model = InterventionProtocol::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'started_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'protocol_name' => fake()->words(3,true),
            'indication' => fake()->sentence(6),
            'status' => 'active',
            'started_at' => now(),
        ];
    }
}
