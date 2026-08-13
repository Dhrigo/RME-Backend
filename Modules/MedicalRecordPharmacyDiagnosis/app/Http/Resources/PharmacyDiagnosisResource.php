<?php

namespace Modules\MedicalRecordPharmacyDiagnosis\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyDiagnosisResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'prescription_id' => $this->prescription_id,
            'problem_category' => $this->problem_category,
            'description' => $this->description,
            'recommendation' => $this->recommendation,
            'assessed_by' => $this->assessed_by,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
