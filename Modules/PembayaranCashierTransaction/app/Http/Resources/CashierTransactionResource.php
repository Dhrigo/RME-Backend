<?php

namespace Modules\PembayaranCashierTransaction\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CashierTransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cashier_id' => $this->cashier_id,
            'invoice_id' => $this->invoice_id,
            'amount' => $this->amount,
            'transaction_type' => $this->transaction_type,
            'transacted_at' => $this->transacted_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
