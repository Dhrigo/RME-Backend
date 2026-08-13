<?php

namespace Modules\MedicalRecordLowerLegExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LowerLegExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'side' => $this->side,
            'muscle_strength' => $this->muscle_strength,
            'edema' => $this->edema,
            'pulses' => $this->pulses,
            'skin_condition' => $this->skin_condition,
            'findings' => $this->findings,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
