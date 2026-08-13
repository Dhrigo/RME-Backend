<?php

namespace Modules\MedicalRecordPainScoreAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PainScoreAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'assessed_by' => $this->assessed_by,
            'created_by' => $this->created_by,
            'scale_type' => $this->scale_type,
            'score' => $this->score,
            'location' => $this->location,
            'character' => $this->character,
            'notes' => $this->notes,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
