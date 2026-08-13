<?php

namespace Modules\InventoryStockOpnameItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockOpnameItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stock_opname_id' => $this->stock_opname_id,
            'item_id' => $this->item_id,
            'system_quantity' => $this->system_quantity,
            'physical_quantity' => $this->physical_quantity,
            'difference' => $this->difference,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
