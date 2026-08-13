<?php

namespace Modules\MedicalRecordFluidBalanceAssessmentDetail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordFluidBalanceAssessment\Models\FluidBalanceAssessment;
use Modules\MedicalRecordFluidBalanceAssessmentDetail\Models\FluidBalanceAssessmentDetail;

class FluidBalanceAssessmentDetailFactory extends Factory
{
    protected $model = FluidBalanceAssessmentDetail::class;

    public function definition(): array
    {
        return [
            'fluid_balance_assessment_id' => FluidBalanceAssessment::factory(),
            'type' => 'intake',
            'category' => 'oral',
            'amount_ml' => 200.00,
            'recorded_at' => now(),
        ];
    }
}
