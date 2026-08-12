<?php

namespace Modules\MedicalRecordClinicalNote\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClinicalNoteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'recorded_at' => $this->recorded_at?->toIso8601String(),
            'subjective' => $this->subjective,
            'objective' => $this->objective,
            'assessment' => $this->assessment,
            'planning' => $this->planning,
            'instructions' => $this->instructions,
            'note_type' => $this->note_type,
            'author_id' => $this->author_id,
            'sub_division' => $this->sub_division,
            'has_discharge_plan' => $this->has_discharge_plan,
            'discharge_plan_date' => $this->discharge_plan_date?->toDateString(),
            'created_by' => $this->created_by,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
