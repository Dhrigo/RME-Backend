<?php

namespace Modules\MedicalRecordFluidFinalBalance\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FluidFinalBalanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'period_date' => $this->period_date?->toIso8601String(),
            'total_intake_ml' => $this->total_intake_ml,
            'total_output_ml' => $this->total_output_ml,
            'balance_ml' => $this->balance_ml,
            'recorded_by' => $this->recorded_by,
            'recorded_at' => $this->recorded_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
