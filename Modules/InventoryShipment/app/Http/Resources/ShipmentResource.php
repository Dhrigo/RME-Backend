<?php

namespace Modules\InventoryShipment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'from_ward_id' => $this->from_ward_id,
            'to_ward_id' => $this->to_ward_id,
            'shipped_by' => $this->shipped_by,
            'shipped_at' => $this->shipped_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
