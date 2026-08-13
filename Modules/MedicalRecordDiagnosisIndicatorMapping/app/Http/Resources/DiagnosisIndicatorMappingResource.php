<?php

namespace Modules\MedicalRecordDiagnosisIndicatorMapping\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiagnosisIndicatorMappingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'diagnosis_id' => $this->diagnosis_id,
            'indicator_code' => $this->indicator_code,
            'indicator_name' => $this->indicator_name,
            'target_score' => $this->target_score,
            'description' => $this->description,
            'is_active' => (bool) $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
