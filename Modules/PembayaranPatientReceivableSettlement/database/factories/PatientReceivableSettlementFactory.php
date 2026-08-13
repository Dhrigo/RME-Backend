<?php

namespace Modules\PembayaranPatientReceivableSettlement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\PembayaranPatientReceivable\Models\PatientReceivable;
use Modules\PembayaranPatientReceivableSettlement\Models\PatientReceivableSettlement;

class PatientReceivableSettlementFactory extends Factory
{
    protected $model = PatientReceivableSettlement::class;

    public function definition(): array
    {
        return [
            'patient_receivable_id' => PatientReceivable::factory(),
            'paid_amount' => fake()->randomFloat(2, 50000, 5000000),
            'paid_at' => now(),
            'received_by' => User::factory(),
        ];
    }
}
