<?php

namespace Modules\LayananTreatmentProtocol\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananTreatmentProtocol\Models\TreatmentProtocol;

class TreatmentProtocolFactory extends Factory
{
    protected $model = TreatmentProtocol::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'protocol_name' => fake()->words(2, true),
            'prescribed_by' => Employee::factory(),
            'started_at' => now(),
            'ended_at' => now(),
            'status' => 'active',
            'notes' => fake()->sentence(),
            'created_by' => User::factory(),
        ];
    }
}
