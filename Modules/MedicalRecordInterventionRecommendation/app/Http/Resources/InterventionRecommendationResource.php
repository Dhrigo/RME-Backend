<?php

namespace Modules\MedicalRecordInterventionRecommendation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterventionRecommendationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'source' => $this->source,
            'recommendation' => $this->recommendation,
            'priority' => $this->priority,
            'recommended_by' => $this->recommended_by,
            'recommended_at' => $this->recommended_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
