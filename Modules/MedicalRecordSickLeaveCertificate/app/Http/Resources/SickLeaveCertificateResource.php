<?php

namespace Modules\MedicalRecordSickLeaveCertificate\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SickLeaveCertificateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'letter_number' => $this->letter_number,
            'patient_id' => $this->patient_id,
            'visit_id' => $this->visit_id,
            'doctor_id' => $this->doctor_id,
            'issue_date' => $this->issue_date?->toDateString(),
            'start_date' => $this->start_date?->toDateString(),
            'end_date' => $this->end_date?->toDateString(),
            'duration_days' => $this->duration_days,
            'diagnosis' => $this->diagnosis,
            'remarks' => $this->remarks,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
