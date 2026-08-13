<?php

namespace Modules\InventoryGoodsReturn\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoodsReturnResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'return_number' => $this->return_number,
            'supplier_id' => $this->supplier_id,
            'returned_by' => $this->returned_by,
            'returned_at' => $this->returned_at?->toIso8601String(),
            'reason' => $this->reason,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
