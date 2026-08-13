<?php

namespace Modules\InventoryReceivingItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReceivingItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'receiving_record_id' => $this->receiving_record_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
