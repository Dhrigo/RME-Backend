<?php

namespace Modules\MedicalRecordNursingCarePlanImplementation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NursingCarePlanImplementationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nursing_care_plan_id' => $this->nursing_care_plan_id,
            'action_taken' => $this->action_taken,
            'performed_by' => $this->performed_by,
            'performed_at' => $this->performed_at?->toIso8601String(),
            'evaluation' => $this->evaluation,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
