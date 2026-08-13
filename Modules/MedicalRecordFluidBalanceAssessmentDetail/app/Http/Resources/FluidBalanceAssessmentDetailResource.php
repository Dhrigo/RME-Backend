<?php

namespace Modules\MedicalRecordFluidBalanceAssessmentDetail\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FluidBalanceAssessmentDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fluid_balance_assessment_id' => $this->fluid_balance_assessment_id,
            'type' => $this->type,
            'category' => $this->category,
            'amount_ml' => $this->amount_ml,
            'recorded_at' => $this->recorded_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
