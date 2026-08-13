<?php

namespace Modules\BerkasKlaimClinicalLabClaimItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClinicalLabClaimItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'clinical_lab_claim_id' => $this->clinical_lab_claim_id,
            'test_name' => $this->test_name,
            'amount' => $this->amount,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
