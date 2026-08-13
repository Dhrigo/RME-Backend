<?php

namespace Modules\PembayaranTransfer\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'payment_id' => $this->payment_id,
            'transfer_reference_number' => $this->transfer_reference_number,
            'source_bank_name' => $this->source_bank_name,
            'destination_account_number' => $this->destination_account_number,
            'destination_account_name' => $this->destination_account_name,
            'amount' => $this->amount,
            'transferred_at' => $this->transferred_at?->toIso8601String(),
            'proof_file_path' => $this->proof_file_path,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
