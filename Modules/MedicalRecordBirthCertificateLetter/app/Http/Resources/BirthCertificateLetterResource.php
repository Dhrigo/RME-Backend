<?php

namespace Modules\MedicalRecordBirthCertificateLetter\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BirthCertificateLetterResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'letter_number' => $this->letter_number,
            'patient_id' => $this->patient_id,
            'mother_patient_id' => $this->mother_patient_id,
            'visit_id' => $this->visit_id,
            'doctor_id' => $this->doctor_id,
            'issue_date' => $this->issue_date?->toDateString(),
            'child_name' => $this->child_name,
            'birth_date_time' => $this->birth_date_time?->toISOString(),
            'birth_weight_grams' => $this->birth_weight_grams,
            'birth_length_cm' => $this->birth_length_cm,
            'gender' => $this->gender,
            'remarks' => $this->remarks,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
