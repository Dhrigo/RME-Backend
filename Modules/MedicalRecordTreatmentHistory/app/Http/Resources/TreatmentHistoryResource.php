<?php

namespace Modules\MedicalRecordTreatmentHistory\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'created_by' => $this->created_by,
            'treatment_description' => $this->treatment_description,
            'facility_name' => $this->facility_name,
            'treatment_date' => $this->treatment_date?->toDateString(),
            'outcome' => $this->outcome,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
