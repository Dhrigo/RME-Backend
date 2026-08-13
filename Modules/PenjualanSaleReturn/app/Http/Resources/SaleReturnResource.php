<?php

namespace Modules\PenjualanSaleReturn\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleReturnResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sale_id' => $this->sale_id,
            'returned_at' => $this->returned_at?->toIso8601String(),
            'reason' => $this->reason,
            'refund_amount' => $this->refund_amount,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
