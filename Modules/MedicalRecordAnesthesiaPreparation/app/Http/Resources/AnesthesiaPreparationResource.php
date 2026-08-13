<?php

namespace Modules\MedicalRecordAnesthesiaPreparation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnesthesiaPreparationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'prepared_by' => $this->prepared_by,
            'created_by' => $this->created_by,
            'fasting_hours' => $this->fasting_hours,
            'allergy_checked' => $this->allergy_checked,
            'mallampati_score' => $this->mallampati_score,
            'consent_confirmed' => $this->consent_confirmed,
            'equipment_checklist' => $this->equipment_checklist,
            'prepared_at' => $this->prepared_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
