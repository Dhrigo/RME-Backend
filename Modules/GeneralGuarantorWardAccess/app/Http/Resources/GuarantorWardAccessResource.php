<?php

namespace Modules\GeneralGuarantorWardAccess\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuarantorWardAccessResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'guarantor_id' => $this->guarantor_id,
            'ward_id' => $this->ward_id,
            'is_allowed' => $this->is_allowed,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
