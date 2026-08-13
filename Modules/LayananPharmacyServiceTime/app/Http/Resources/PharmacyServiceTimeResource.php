<?php

namespace Modules\LayananPharmacyServiceTime\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyServiceTimeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'prescription_id' => $this->prescription_id,
            'received_at' => $this->received_at?->toIso8601String(),
            'prepared_at' => $this->prepared_at?->toIso8601String(),
            'dispensed_at' => $this->dispensed_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
