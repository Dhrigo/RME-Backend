<?php

namespace Modules\LayananBirthRecord\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BirthRecordResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'mother_patient_id' => $this->mother_patient_id,
            'baby_name' => $this->baby_name,
            'gender_id' => $this->gender_id,
            'birth_date' => $this->birth_date?->toIso8601String(),
            'birth_weight_grams' => $this->birth_weight_grams,
            'birth_length_cm' => $this->birth_length_cm,
            'delivery_method' => $this->delivery_method,
            'attending_doctor_id' => $this->attending_doctor_id,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
