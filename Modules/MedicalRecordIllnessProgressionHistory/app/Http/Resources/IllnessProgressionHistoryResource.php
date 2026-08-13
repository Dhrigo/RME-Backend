<?php

namespace Modules\MedicalRecordIllnessProgressionHistory\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IllnessProgressionHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'created_by' => $this->created_by,
            'symptom_onset_date' => $this->symptom_onset_date?->toDateString(),
            'progression_description' => $this->progression_description,
            'prior_treatment' => $this->prior_treatment,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
