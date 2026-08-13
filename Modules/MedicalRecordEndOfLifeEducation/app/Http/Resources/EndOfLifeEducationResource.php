<?php

namespace Modules\MedicalRecordEndOfLifeEducation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EndOfLifeEducationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'topic' => $this->topic,
            'participants' => $this->participants,
            'decision_summary' => $this->decision_summary,
            'educator_id' => $this->educator_id,
            'educated_at' => $this->educated_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
