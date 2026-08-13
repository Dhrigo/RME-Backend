<?php

namespace Modules\LayananAntimicrobialStewardshipGeneralExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AntimicrobialStewardshipGeneralExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'antimicrobial_stewardship_form_id' => $this->antimicrobial_stewardship_form_id,
            'temperature' => $this->temperature,
            'pulse' => $this->pulse,
            'respiration_rate' => $this->respiration_rate,
            'blood_pressure' => $this->blood_pressure,
            'weight_kg' => $this->weight_kg,
            'height_cm' => $this->height_cm,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
