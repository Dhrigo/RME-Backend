<?php

namespace Modules\InventoryItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'category' => $this->category,
            'unit' => $this->unit,
            'brand' => $this->brand,
            'is_generic' => $this->is_generic,
            'is_formulary' => $this->is_formulary,
            'buy_price' => $this->buy_price,
            'sell_price' => $this->sell_price,
            'stock_quantity' => $this->stock_quantity,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
