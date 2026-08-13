<?php

namespace Modules\BerkasKlaimRadiologyClaimItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RadiologyClaimItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'radiology_claim_id' => $this->radiology_claim_id,
            'exam_name' => $this->exam_name,
            'amount' => $this->amount,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
