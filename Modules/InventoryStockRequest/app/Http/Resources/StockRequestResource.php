<?php

namespace Modules\InventoryStockRequest\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockRequestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'request_number' => $this->request_number,
            'ward_id' => $this->ward_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'requested_by' => $this->requested_by,
            'requested_at' => $this->requested_at?->toIso8601String(),
            'fulfilled_at' => $this->fulfilled_at?->toIso8601String(),
            'notes' => $this->notes,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
