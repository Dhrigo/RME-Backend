<?php

namespace Modules\MedicalRecordFluidBalanceAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordFluidBalanceAssessment\Models\FluidBalanceAssessment;

class FluidBalanceAssessmentFactory extends Factory
{
    protected $model = FluidBalanceAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'shift' => 'pagi',
            'assessed_at' => now(),
            'total_intake_ml' => 1500.00,
            'total_output_ml' => 1200.00,
            'balance_ml' => 300.00,
        ];
    }
}
