<?php

namespace Modules\PembayaranClaimInvoice\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClaimInvoiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'claim_number' => $this->claim_number,
            'invoice_id' => $this->invoice_id,
            'guarantor_id' => $this->guarantor_id,
            'claim_amount' => $this->claim_amount,
            'verified_amount' => $this->verified_amount,
            'submitted_at' => $this->submitted_at?->toIso8601String(),
            'status' => $this->status,
            'rejection_reason' => $this->rejection_reason,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
