<?php

namespace Modules\MedicalRecordNursingCarePlan\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NursingCarePlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'assessment' => $this->assessment,
            'goal' => $this->goal,
            'intervention_plan' => $this->intervention_plan,
            'target_date' => $this->target_date?->toIso8601String(),
            'recorded_by' => $this->recorded_by,
            'recorded_at' => $this->recorded_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
