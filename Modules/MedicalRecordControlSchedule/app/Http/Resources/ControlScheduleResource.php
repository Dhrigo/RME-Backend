<?php

namespace Modules\MedicalRecordControlSchedule\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ControlScheduleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'visit_id' => $this->visit_id,
            'medical_department_id' => $this->medical_department_id,
            'scheduled_date' => $this->scheduled_date?->toIso8601String(),
            'purpose' => $this->purpose,
            'scheduled_by' => $this->scheduled_by,
            'status' => $this->status,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
