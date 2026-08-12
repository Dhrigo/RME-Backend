<?php

namespace Modules\MedicalRecordVitalSign\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VitalSignResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'recorded_at' => $this->recorded_at?->toIso8601String(),
            'temperature' => $this->temperature,
            'pulse' => $this->pulse,
            'respiratory_rate' => $this->respiratory_rate,
            'systolic' => $this->systolic,
            'diastolic' => $this->diastolic,
            'oxygen_saturation' => $this->oxygen_saturation,
            'pain_scale' => $this->pain_scale,
            'recorded_by' => $this->recorded_by,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
