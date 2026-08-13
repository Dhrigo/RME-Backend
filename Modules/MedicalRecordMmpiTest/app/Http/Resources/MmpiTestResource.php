<?php

namespace Modules\MedicalRecordMmpiTest\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MmpiTestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'visit_id' => $this->visit_id,
            'doctor_id' => $this->doctor_id,
            'test_date' => $this->test_date?->toISOString(),
            'validity_scale_l' => $this->validity_scale_l,
            'validity_scale_f' => $this->validity_scale_f,
            'validity_scale_k' => $this->validity_scale_k,
            'clinical_scales_summary' => $this->clinical_scales_summary,
            'interpretation' => $this->interpretation,
            'conclusion' => $this->conclusion,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
