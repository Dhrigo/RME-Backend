<?php

namespace Modules\MedicalRecordHealthCertificate\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HealthCertificateResource extends JsonResource
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
            'physical_fitness_status' => $this->physical_fitness_status,
            'purpose' => $this->purpose,
            'blood_pressure' => $this->blood_pressure,
            'height_cm' => $this->height_cm,
            'weight_kg' => $this->weight_kg,
            'remarks' => $this->remarks,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
