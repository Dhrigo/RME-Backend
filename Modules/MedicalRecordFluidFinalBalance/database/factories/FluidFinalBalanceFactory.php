<?php

namespace Modules\MedicalRecordFluidFinalBalance\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordFluidFinalBalance\Models\FluidFinalBalance;

class FluidFinalBalanceFactory extends Factory
{
    protected $model = FluidFinalBalance::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'period_date' => now()->toDateString(),
            'total_intake_ml' => fake()->randomFloat(2, 1, 100),
            'total_output_ml' => fake()->randomFloat(2, 1, 100),
            'balance_ml' => fake()->randomFloat(2, 1, 100),
            'recorded_by' => Employee::factory(),
            'recorded_at' => now(),
        ];
    }
}
