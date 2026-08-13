<?php

namespace Modules\InventoryGoodsReceiptCancellation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoodsReceiptCancellationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cancellation_number' => $this->cancellation_number,
            'goods_receipt_id' => $this->goods_receipt_id,
            'reason' => $this->reason,
            'cancelled_by' => $this->cancelled_by,
            'cancelled_at' => $this->cancelled_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
