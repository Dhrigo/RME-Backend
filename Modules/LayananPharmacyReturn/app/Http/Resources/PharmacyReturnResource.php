<?php

namespace Modules\LayananPharmacyReturn\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyReturnResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'prescription_item_id' => $this->prescription_item_id,
            'quantity_returned' => $this->quantity_returned,
            'reason' => $this->reason,
            'returned_by' => $this->returned_by,
            'returned_at' => $this->returned_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
