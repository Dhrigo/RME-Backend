<?php

namespace Modules\MedicalRecordRehabilitationProcedureExaminationItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RehabilitationProcedureExaminationItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'rehabilitation_procedure_examination_id' => $this->rehabilitation_procedure_examination_id,
            'step_name' => $this->step_name,
            'duration_minutes' => $this->duration_minutes,
            'result' => $this->result,
            'sequence' => $this->sequence,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
