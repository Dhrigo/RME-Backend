<?php

namespace Modules\MedicalRecordParentalHealthHistoryScreening\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentalHealthHistoryScreeningResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'screened_by' => $this->screened_by,
            'created_by' => $this->created_by,
            'father_health_conditions' => $this->father_health_conditions,
            'mother_health_conditions' => $this->mother_health_conditions,
            'consanguinity' => $this->consanguinity,
            'genetic_disorder_history' => $this->genetic_disorder_history,
            'screened_at' => $this->screened_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
