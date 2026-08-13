<?php

namespace Modules\MedicalRecordProcedureConsentInformationReceiver\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordProcedureConsentInformationReceiver\Models\ProcedureConsentInformationReceiver;

class ProcedureConsentInformationReceiverFactory extends Factory
{
    protected $model = ProcedureConsentInformationReceiver::class;

    public function definition(): array
    {
        return [
            'consent_id' => \Modules\MedicalRecordDoctorProcedureConsent\Models\DoctorProcedureConsent::factory(),
            'receiver_name' => fake()->name(),
            'receiver_relationship' => 'self',
            'signed_at' => now(),
        ];
    }
}
