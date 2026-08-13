<?php

namespace Modules\MedicalRecordSkinPrickTestExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkinPrickTestExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'allergen' => $this->allergen,
            'wheal_size_mm' => $this->wheal_size_mm,
            'flare_size_mm' => $this->flare_size_mm,
            'result' => $this->result,
            'reaction_onset_minutes' => $this->reaction_onset_minutes,
            'notes' => $this->notes,
            'tested_at' => $this->tested_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
