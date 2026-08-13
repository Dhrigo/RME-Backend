<?php

namespace Modules\MedicalRecordHemodialysisLetter\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HemodialysisLetterResource extends JsonResource
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
            'diagnosis' => $this->diagnosis,
            'hd_frequency_per_week' => $this->hd_frequency_per_week,
            'vascular_access' => $this->vascular_access,
            'remarks' => $this->remarks,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
