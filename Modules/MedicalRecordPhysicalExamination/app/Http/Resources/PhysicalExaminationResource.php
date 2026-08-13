<?php

namespace Modules\MedicalRecordPhysicalExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhysicalExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'general_condition' => $this->general_condition,
            'consciousness_gcs' => $this->consciousness_gcs,
            'head_to_toe_notes' => $this->head_to_toe_notes,
            'examined_by' => $this->examined_by,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
