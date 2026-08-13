<?php

namespace Modules\MedicalRecordFingernailExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FingernailExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'color' => $this->color,
            'capillary_refill_seconds' => $this->capillary_refill_seconds,
            'clubbing' => $this->clubbing,
            'cyanosis' => $this->cyanosis,
            'lesions' => $this->lesions,
            'findings' => $this->findings,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
