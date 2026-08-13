<?php

namespace Modules\LayananPatientDischargeRecord\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientDischargeRecordResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'discharged_at' => $this->discharged_at?->toIso8601String(),
            'discharge_method' => $this->discharge_method,
            'discharged_by' => $this->discharged_by,
            'follow_up_notes' => $this->follow_up_notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
