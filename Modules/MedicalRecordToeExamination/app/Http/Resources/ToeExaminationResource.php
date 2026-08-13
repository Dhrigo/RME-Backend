<?php

namespace Modules\MedicalRecordToeExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ToeExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'foot_side' => $this->foot_side,
            'deformity' => $this->deformity,
            'ulceration' => (bool) $this->ulceration,
            'capillary_refill_seconds' => $this->capillary_refill_seconds,
            'sensation_monofilament' => $this->sensation_monofilament,
            'notes' => $this->notes,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
