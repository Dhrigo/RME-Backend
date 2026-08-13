<?php

namespace Modules\MedicalRecordNoseExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoseExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'deformity' => $this->deformity,
            'septum_deviation' => (bool) $this->septum_deviation,
            'turbinate_hypertrophy' => (bool) $this->turbinate_hypertrophy,
            'nasal_discharge' => $this->nasal_discharge,
            'polyp_present' => (bool) $this->polyp_present,
            'notes' => $this->notes,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
