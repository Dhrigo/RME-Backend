<?php

namespace Modules\MedicalRecordFamilyMedicalHistory\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyMedicalHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'created_by' => $this->created_by,
            'relation' => $this->relation,
            'condition' => $this->condition,
            'diagnosed_age' => $this->diagnosed_age,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
