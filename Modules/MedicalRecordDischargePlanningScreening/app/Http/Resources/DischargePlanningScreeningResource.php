<?php

namespace Modules\MedicalRecordDischargePlanningScreening\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DischargePlanningScreeningResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'screening_criteria' => $this->screening_criteria,
            'total_score' => $this->total_score,
            'requires_planning' => $this->requires_planning,
            'screened_by' => $this->screened_by,
            'screened_at' => $this->screened_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
