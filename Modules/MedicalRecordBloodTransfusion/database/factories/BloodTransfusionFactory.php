<?php

namespace Modules\MedicalRecordBloodTransfusion\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\KemkesBloodType\Models\BloodType;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;
use Modules\PendaftaranVisit\Models\Visit;

class BloodTransfusionFactory extends Factory
{
    protected $model = BloodTransfusion::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'blood_type_id' => BloodType::factory(),
            'volume_ml' => fake()->numberBetween(200, 500),
            'started_at' => now(),
            'ended_at' => null,
            'administered_by' => Employee::factory(),
            'reaction_notes' => null,
            'status' => 'in_progress',
            'created_by' => null,
        ];
    }
}
