<?php

namespace Modules\PembayaranDeposit\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepositResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'deposit_number' => $this->deposit_number,
            'visit_id' => $this->visit_id,
            'amount' => $this->amount,
            'paid_at' => $this->paid_at?->toIso8601String(),
            'received_by' => $this->received_by,
            'notes' => $this->notes,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
