<?php

namespace Modules\BerkasKlaimPharmacyClaim\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyClaimResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'claim_file_id' => $this->claim_file_id,
            'prescription_id' => $this->prescription_id,
            'submitted_at' => $this->submitted_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
