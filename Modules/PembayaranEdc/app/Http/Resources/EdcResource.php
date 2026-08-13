<?php

namespace Modules\PembayaranEdc\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EdcResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'payment_id' => $this->payment_id,
            'edc_reference_number' => $this->edc_reference_number,
            'bank_name' => $this->bank_name,
            'card_type' => $this->card_type,
            'card_last_four' => $this->card_last_four,
            'approval_code' => $this->approval_code,
            'amount' => $this->amount,
            'transaction_at' => $this->transaction_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
