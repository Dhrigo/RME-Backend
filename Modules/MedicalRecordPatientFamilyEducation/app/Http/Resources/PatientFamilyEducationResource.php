<?php

namespace Modules\MedicalRecordPatientFamilyEducation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientFamilyEducationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'topic' => $this->topic,
            'method' => $this->method,
            'barrier' => $this->barrier,
            'understanding_level' => $this->understanding_level,
            're_education_needed' => $this->re_education_needed,
            'educator_id' => $this->educator_id,
            'educated_at' => $this->educated_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
