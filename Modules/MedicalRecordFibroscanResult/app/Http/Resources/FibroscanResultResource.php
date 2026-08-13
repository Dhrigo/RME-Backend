<?php

namespace Modules\MedicalRecordFibroscanResult\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FibroscanResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'examination_date' => $this->examination_date?->toIso8601String(),
            'liver_stiffness_kpa' => $this->liver_stiffness_kpa,
            'cap_score' => $this->cap_score,
            'fibrosis_stage' => $this->fibrosis_stage,
            'examined_by' => $this->examined_by,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
