<?php

namespace Modules\LayananPrescription\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'prescription_number' => $this->prescription_number,
            'visit_id' => $this->visit_id,
            'diagnosis_id' => $this->diagnosis_id,
            'prescribed_by' => $this->prescribed_by,
            'prescribed_at' => $this->prescribed_at?->toIso8601String(),
            'weight_kg' => $this->weight_kg,
            'height_cm' => $this->height_cm,
            'has_drug_allergy' => $this->has_drug_allergy,
            'is_pregnant' => $this->is_pregnant,
            'is_breastfeeding' => $this->is_breastfeeding,
            'is_discharge_prescription' => $this->is_discharge_prescription,
            'is_emergency' => $this->is_emergency,
            'notes' => $this->notes,
            'status' => $this->status,
            'items' => $this->whenLoaded('items', fn () => $this->items->map(fn ($item) => [
                'id' => $item->id,
                'drug_name' => $item->drug_name,
                'dosage' => $item->dosage,
                'frequency' => $item->frequency,
                'route' => $item->route,
                'duration' => $item->duration,
                'quantity' => $item->quantity,
            ])),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
