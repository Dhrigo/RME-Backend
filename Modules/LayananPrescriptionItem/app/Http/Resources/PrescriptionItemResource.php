<?php

namespace Modules\LayananPrescriptionItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'prescription_id' => $this->prescription_id,
            'item_id' => $this->item_id,
            'drug_name' => $this->drug_name,
            'dosage' => $this->dosage,
            'frequency' => $this->frequency,
            'route' => $this->route,
            'duration' => $this->duration,
            'quantity' => $this->quantity,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
