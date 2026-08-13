<?php

namespace Modules\MedicalRecordFingerExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FingerExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'hand_side' => $this->hand_side,
            'clubbing' => (bool) $this->clubbing,
            'cyanosis' => (bool) $this->cyanosis,
            'capillary_refill_seconds' => $this->capillary_refill_seconds,
            'range_of_motion' => $this->range_of_motion,
            'notes' => $this->notes,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
