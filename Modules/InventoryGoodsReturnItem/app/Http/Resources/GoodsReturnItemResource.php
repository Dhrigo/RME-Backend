<?php

namespace Modules\InventoryGoodsReturnItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoodsReturnItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'goods_return_id' => $this->goods_return_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'reason' => $this->reason,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
