<?php

namespace Modules\LayananRadiologyOrder\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RadiologyOrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'ordering_doctor_id' => $this->ordering_doctor_id,
            'ordered_at' => $this->ordered_at?->toIso8601String(),
            'clinical_notes' => $this->clinical_notes,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
