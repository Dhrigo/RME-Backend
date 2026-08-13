<?php

namespace Modules\BerkasKlaimPharmacyClaimItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyClaimItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pharmacy_claim_id' => $this->pharmacy_claim_id,
            'drug_name' => $this->drug_name,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'amount' => $this->amount,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
