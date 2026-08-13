<?php

namespace Modules\LayananPharmacyServiceTimeStage\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPharmacyServiceTime\Models\PharmacyServiceTime;
use Modules\LayananPharmacyServiceTimeStage\Models\PharmacyServiceTimeStage;

class PharmacyServiceTimeStageFactory extends Factory
{
    protected $model = PharmacyServiceTimeStage::class;

    public function definition(): array
    {
        return [
            'pharmacy_service_time_id' => PharmacyServiceTime::factory(),
            'stage_name' => fake()->words(2, true),
            'recorded_at' => now(),
            'recorded_by' => Employee::factory(),
        ];
    }
}
