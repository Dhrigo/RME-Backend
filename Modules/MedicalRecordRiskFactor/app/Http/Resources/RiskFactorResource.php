<?php

namespace Modules\MedicalRecordRiskFactor\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RiskFactorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'risk_category' => $this->risk_category,
            'description' => $this->description,
            'risk_level' => $this->risk_level,
            'identified_by' => $this->identified_by,
            'identified_at' => $this->identified_at?->toIso8601String(),
            'mitigation_plan' => $this->mitigation_plan,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
