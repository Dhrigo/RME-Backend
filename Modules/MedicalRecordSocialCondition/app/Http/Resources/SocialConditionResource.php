<?php

namespace Modules\MedicalRecordSocialCondition\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialConditionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'living_situation' => $this->living_situation,
            'occupation_status' => $this->occupation_status,
            'financial_status' => $this->financial_status,
            'support_system' => $this->support_system,
            'recorded_by' => $this->recorded_by,
            'recorded_at' => $this->recorded_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
