<?php

namespace Modules\MedicalRecordEyeExamDocumentUpload\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EyeExamDocumentUploadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'visit_id' => $this->visit_id,
            'doctor_id' => $this->doctor_id,
            'exam_date' => $this->exam_date?->toISOString(),
            'file_path' => $this->file_path,
            'eye_side' => $this->eye_side,
            'findings' => $this->findings,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
