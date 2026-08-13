<?php

namespace Modules\GeneralDiagnosisRestriction\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiagnosisRestrictionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'diagnosis_code_id' => $this->diagnosis_code_id,
            'restricted_antibiotic_name' => $this->restricted_antibiotic_name,
            'requires_justification' => $this->requires_justification,
            'notes' => $this->notes,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
