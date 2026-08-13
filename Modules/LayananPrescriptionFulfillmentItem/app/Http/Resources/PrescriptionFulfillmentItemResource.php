<?php

namespace Modules\LayananPrescriptionFulfillmentItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionFulfillmentItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'prescription_fulfillment_id' => $this->prescription_fulfillment_id,
            'prescription_item_id' => $this->prescription_item_id,
            'quantity_served' => $this->quantity_served,
            'is_substituted' => $this->is_substituted,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
