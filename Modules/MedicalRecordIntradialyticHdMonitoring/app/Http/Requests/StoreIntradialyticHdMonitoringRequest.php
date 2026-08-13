<?php

namespace Modules\MedicalRecordIntradialyticHdMonitoring\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIntradialyticHdMonitoringRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'patient_id' => 'required|integer',
            'dialysis_hour' => 'nullable|integer',
            'blood_pressure_systolic' => 'nullable|integer',
            'blood_pressure_diastolic' => 'nullable|integer',
            'blood_flow_rate' => 'nullable|integer',
            'dialysate_flow_rate' => 'nullable|integer',
            'ultrafiltration_rate' => 'nullable|integer',
            'venous_pressure' => 'nullable|integer',
            'transmembrane_pressure' => 'nullable|integer',
            'symptoms' => 'nullable|string',
            'monitored_at' => 'nullable|date',
        ];
    }
}
