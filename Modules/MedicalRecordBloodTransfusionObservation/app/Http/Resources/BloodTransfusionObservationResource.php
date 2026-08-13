<?php

namespace Modules\MedicalRecordBloodTransfusionObservation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BloodTransfusionObservationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'blood_transfusion_id' => $this->blood_transfusion_id,
            'observed_at' => $this->observed_at?->toIso8601String(),
            'temperature_c' => $this->temperature_c,
            'pulse_rate' => $this->pulse_rate,
            'blood_pressure' => $this->blood_pressure,
            'reaction_signs' => $this->reaction_signs,
            'volume_transfused_ml' => $this->volume_transfused_ml,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
