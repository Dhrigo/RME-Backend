<?php

namespace Modules\MedicalRecordSurgeryPerformer\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurgeryPerformerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'surgery_id' => $this->surgery_id,
            'visit_id' => $this->visit_id,
            'doctor_id' => $this->doctor_id,
            'role' => $this->role,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
