<?php

namespace Modules\MedicalRecordSurgery\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurgeryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'diagnosis_id' => $this->diagnosis_id,
            'procedure_name' => $this->procedure_name,
            'surgeon_id' => $this->surgeon_id,
            'anesthesia_type' => $this->anesthesia_type,
            'started_at' => $this->started_at?->toIso8601String(),
            'ended_at' => $this->ended_at?->toIso8601String(),
            'notes' => $this->notes,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
