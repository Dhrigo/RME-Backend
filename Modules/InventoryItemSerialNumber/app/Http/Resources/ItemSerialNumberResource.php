<?php

namespace Modules\InventoryItemSerialNumber\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemSerialNumberResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ward_item_stock_id' => $this->ward_item_stock_id,
            'serial_number' => $this->serial_number,
            'expiry_date' => $this->expiry_date?->toDateString(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
