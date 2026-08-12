<?php

namespace Modules\MedicalRecordDiagnosis\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiagnosisResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'diagnosis_code_id' => $this->diagnosis_code_id,
            'is_primary' => $this->is_primary,
            'recorded_at' => $this->recorded_at?->toIso8601String(),
            'recorded_by' => $this->recorded_by,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
