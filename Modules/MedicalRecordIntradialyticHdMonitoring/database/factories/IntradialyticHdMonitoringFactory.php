<?php

namespace Modules\MedicalRecordIntradialyticHdMonitoring\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordIntradialyticHdMonitoring\Models\IntradialyticHdMonitoring;

class IntradialyticHdMonitoringFactory extends Factory
{
    protected $model = IntradialyticHdMonitoring::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'patient_id' => 1,
            'dialysis_hour' => 1,
            'blood_pressure_systolic' => 120,
            'blood_pressure_diastolic' => 80,
            'blood_flow_rate' => 200,
            'dialysate_flow_rate' => 500,
            'ultrafiltration_rate' => 300,
            'monitored_at' => now(),
        ];
    }
}
