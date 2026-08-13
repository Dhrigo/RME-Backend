<?php

namespace Modules\PembayaranPatientReceivable\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPatientReceivable\Models\PatientReceivable;

class PatientReceivableFactory extends Factory
{
    protected $model = PatientReceivable::class;

    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::factory(),
            'patient_id' => Patient::factory(),
            'amount' => fake()->randomFloat(2, 50000, 5000000),
            'due_date' => now()->addDays(30)->toDateString(),
            'status' => 'outstanding',
        ];
    }
}
