<?php

namespace Modules\GeneralPatient\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'medical_record_number' => $this->medical_record_number,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'title_prefix' => $this->title_prefix,
            'title_suffix' => $this->title_suffix,
            'birth_place' => $this->birth_place,
            'birth_date' => $this->birth_date?->toDateString(),
            'gender_id' => $this->gender_id,
            'religion_id' => $this->religion_id,
            'address' => $this->address,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'postal_code' => $this->postal_code,
            'village_id' => $this->village_id,
            'education_id' => $this->education_id,
            'occupation_id' => $this->occupation_id,
            'marital_status_id' => $this->marital_status_id,
            'blood_type_id' => $this->blood_type_id,
            'nationality_id' => $this->nationality_id,
            'ethnicity_id' => $this->ethnicity_id,
            'language_id' => $this->language_id,
            'is_unidentified' => $this->is_unidentified,
            'registered_by' => $this->registered_by,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
