<?php

namespace Modules\MedicalRecordMorseFallScaleAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MorseFallScaleAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'assessed_by' => $this->assessed_by,
            'created_by' => $this->created_by,
            'history_of_falling' => $this->history_of_falling,
            'secondary_diagnosis' => $this->secondary_diagnosis,
            'ambulatory_aid' => $this->ambulatory_aid,
            'iv_therapy' => $this->iv_therapy,
            'gait' => $this->gait,
            'mental_status' => $this->mental_status,
            'total_score' => $this->total_score,
            'risk_level' => $this->risk_level,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
