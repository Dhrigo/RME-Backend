<?php

namespace Modules\MedicalRecordGynecologyUltrasound\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GynecologyUltrasoundResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'visit_id' => $this->visit_id,
            'doctor_id' => $this->doctor_id,
            'exam_date' => $this->exam_date?->toISOString(),
            'uterus_findings' => $this->uterus_findings,
            'right_ovary_findings' => $this->right_ovary_findings,
            'left_ovary_findings' => $this->left_ovary_findings,
            'endometrial_thickness_mm' => $this->endometrial_thickness_mm,
            'conclusion' => $this->conclusion,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
