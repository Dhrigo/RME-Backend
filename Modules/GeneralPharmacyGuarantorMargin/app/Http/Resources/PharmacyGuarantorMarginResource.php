<?php

namespace Modules\GeneralPharmacyGuarantorMargin\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyGuarantorMarginResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'guarantor_id' => $this->guarantor_id,
            'margin_percentage' => $this->margin_percentage,
            'effective_date' => $this->effective_date?->toDateString(),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
