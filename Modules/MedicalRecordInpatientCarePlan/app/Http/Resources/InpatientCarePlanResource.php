<?php

namespace Modules\MedicalRecordInpatientCarePlan\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InpatientCarePlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'planned_by' => $this->planned_by,
            'created_by' => $this->created_by,
            'care_goals' => $this->care_goals,
            'planned_length_of_stay_days' => $this->planned_length_of_stay_days,
            'discharge_criteria' => $this->discharge_criteria,
            'status' => $this->status,
            'planned_at' => $this->planned_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
