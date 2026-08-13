<?php

namespace Modules\PembayaranDepositRefund\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepositRefundResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'deposit_id' => $this->deposit_id,
            'refunded_amount' => $this->refunded_amount,
            'refunded_at' => $this->refunded_at?->toIso8601String(),
            'refunded_by' => $this->refunded_by,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
