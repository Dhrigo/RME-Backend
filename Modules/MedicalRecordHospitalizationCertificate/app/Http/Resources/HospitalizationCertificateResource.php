<?php

namespace Modules\MedicalRecordHospitalizationCertificate\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HospitalizationCertificateResource extends JsonResource
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
            'admission_date' => $this->admission_date?->toDateString(),
            'estimated_duration_days' => $this->estimated_duration_days,
            'ward_name' => $this->ward_name,
            'diagnosis' => $this->diagnosis,
            'remarks' => $this->remarks,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
