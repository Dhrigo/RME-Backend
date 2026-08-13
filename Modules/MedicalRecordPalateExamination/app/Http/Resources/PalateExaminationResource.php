<?php

namespace Modules\MedicalRecordPalateExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PalateExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'hard_palate' => $this->hard_palate,
            'soft_palate' => $this->soft_palate,
            'uvula_position' => $this->uvula_position,
            'cleft_palate' => $this->cleft_palate,
            'findings' => $this->findings,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
