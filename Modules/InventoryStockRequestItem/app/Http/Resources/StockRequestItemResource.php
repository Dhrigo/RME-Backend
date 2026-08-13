<?php

namespace Modules\InventoryStockRequestItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockRequestItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stock_request_id' => $this->stock_request_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
