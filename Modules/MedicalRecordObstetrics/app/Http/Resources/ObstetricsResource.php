<?php

namespace Modules\MedicalRecordObstetrics\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ObstetricsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'gravida' => $this->gravida,
            'para' => $this->para,
            'abortus' => $this->abortus,
            'gestational_age_weeks' => $this->gestational_age_weeks,
            'fundal_height_cm' => $this->fundal_height_cm,
            'fetal_heart_rate' => $this->fetal_heart_rate,
            'fetal_presentation' => $this->fetal_presentation,
            'estimated_fetal_weight' => $this->estimated_fetal_weight,
            'notes' => $this->notes,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
