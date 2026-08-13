<?php

namespace Modules\LayananMedicationServiceLimit\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicationServiceLimitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'item_id' => $this->item_id,
            'guarantor_type' => $this->guarantor_type,
            'max_quantity_per_month' => $this->max_quantity_per_month,
            'max_days_supply' => $this->max_days_supply,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
