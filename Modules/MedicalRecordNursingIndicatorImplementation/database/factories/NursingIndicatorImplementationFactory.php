<?php

namespace Modules\MedicalRecordNursingIndicatorImplementation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordNursingIndicator\Models\NursingIndicator;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordNursingIndicatorImplementation\Models\NursingIndicatorImplementation;

class NursingIndicatorImplementationFactory extends Factory
{
    protected $model = NursingIndicatorImplementation::class;

    public function definition(): array
    {
        return [
            'nursing_indicator_id' => NursingIndicator::factory(),
            'visit_id' => Visit::factory(),
            'value_recorded' => fake()->words(3, true),
            'recorded_by' => Employee::factory(),
            'recorded_at' => now(),
            'notes' => fake()->sentence(),
        ];
    }
}
