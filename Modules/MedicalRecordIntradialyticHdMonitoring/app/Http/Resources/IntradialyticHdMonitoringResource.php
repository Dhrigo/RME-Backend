<?php

namespace Modules\MedicalRecordIntradialyticHdMonitoring\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IntradialyticHdMonitoringResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'dialysis_hour' => $this->dialysis_hour,
            'blood_pressure_systolic' => $this->blood_pressure_systolic,
            'blood_pressure_diastolic' => $this->blood_pressure_diastolic,
            'blood_flow_rate' => $this->blood_flow_rate,
            'dialysate_flow_rate' => $this->dialysate_flow_rate,
            'ultrafiltration_rate' => $this->ultrafiltration_rate,
            'venous_pressure' => $this->venous_pressure,
            'transmembrane_pressure' => $this->transmembrane_pressure,
            'symptoms' => $this->symptoms,
            'monitored_at' => $this->monitored_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
