<?php

namespace Modules\MedicalRecordKillipClassAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KillipClassAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'assessed_by' => $this->assessed_by,
            'created_by' => $this->created_by,
            'killip_class' => $this->killip_class,
            'heart_rate' => $this->heart_rate,
            'respiratory_rate' => $this->respiratory_rate,
            'rales_present' => $this->rales_present,
            's3_gallop_present' => $this->s3_gallop_present,
            'notes' => $this->notes,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
