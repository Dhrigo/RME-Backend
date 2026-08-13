<?php

namespace Modules\GeneralGuarantorSubspecialty\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuarantorSubspecialtyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'guarantor_id' => $this->guarantor_id,
            'subspecialty_name' => $this->subspecialty_name,
            'is_covered' => $this->is_covered,
            'coverage_note' => $this->coverage_note,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
