<?php

namespace Modules\InventoryShipmentItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'shipment_id' => $this->shipment_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
