<?php

namespace Modules\MedicalRecordEndOfLifePsychosocialRelationship\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EndOfLifePsychosocialRelationshipResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'relationship_type' => $this->relationship_type,
            'support_system' => $this->support_system,
            'spiritual_needs' => $this->spiritual_needs,
            'emotional_state' => $this->emotional_state,
            'assessed_by' => $this->assessed_by,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
