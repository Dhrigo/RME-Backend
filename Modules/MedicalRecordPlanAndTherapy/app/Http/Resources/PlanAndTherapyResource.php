<?php

namespace Modules\MedicalRecordPlanAndTherapy\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanAndTherapyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'ordered_by' => $this->ordered_by,
            'created_by' => $this->created_by,
            'assessment_summary' => $this->assessment_summary,
            'plan_description' => $this->plan_description,
            'therapy_type' => $this->therapy_type,
            'target_date' => $this->target_date?->toDateString(),
            'status' => $this->status,
            'ordered_at' => $this->ordered_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
