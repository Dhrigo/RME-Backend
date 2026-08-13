<?php

namespace Modules\MedicalRecordRehabilitationProcedureExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RehabilitationProcedureExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'procedure_name' => $this->procedure_name,
            'therapist_id' => $this->therapist_id,
            'diagnosis_summary' => $this->diagnosis_summary,
            'functional_goal' => $this->functional_goal,
            'notes' => $this->notes,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
