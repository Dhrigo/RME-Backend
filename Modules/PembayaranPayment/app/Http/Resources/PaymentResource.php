<?php

namespace Modules\PembayaranPayment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'payment_number' => $this->payment_number,
            'invoice_id' => $this->invoice_id,
            'payment_method' => $this->payment_method,
            'amount' => $this->amount,
            'admin_fee' => $this->admin_fee,
            'paid_at' => $this->paid_at?->toIso8601String(),
            'received_by' => $this->received_by,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
