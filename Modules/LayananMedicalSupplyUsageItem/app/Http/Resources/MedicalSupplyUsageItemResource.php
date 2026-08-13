<?php

namespace Modules\LayananMedicalSupplyUsageItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicalSupplyUsageItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'medical_supply_usage_id' => $this->medical_supply_usage_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
