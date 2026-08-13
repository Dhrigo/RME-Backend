<?php

namespace Modules\LayananPharmacyDispense\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyDispenseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'prescription_id' => $this->prescription_id,
            'dispensed_by' => $this->dispensed_by,
            'dispensed_at' => $this->dispensed_at?->toIso8601String(),
            'quantity' => $this->quantity,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
