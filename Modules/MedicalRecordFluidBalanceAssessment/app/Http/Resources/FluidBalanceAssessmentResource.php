<?php

namespace Modules\MedicalRecordFluidBalanceAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FluidBalanceAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'shift' => $this->shift,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'total_intake_ml' => $this->total_intake_ml,
            'total_output_ml' => $this->total_output_ml,
            'balance_ml' => $this->balance_ml,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
