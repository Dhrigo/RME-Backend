<?php

namespace Modules\GeneralPrescriptionOriginUnitRestriction\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionOriginUnitRestrictionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ward_id' => $this->ward_id,
            'item_id' => $this->item_id,
            'is_allowed' => $this->is_allowed,
            'note' => $this->note,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
