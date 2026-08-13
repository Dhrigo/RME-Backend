<?php

namespace Modules\MedicalRecordGynecologyHistory\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GynecologyHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'created_by' => $this->created_by,
            'menarche_age' => $this->menarche_age,
            'menstrual_cycle_pattern' => $this->menstrual_cycle_pattern,
            'contraception_history' => $this->contraception_history,
            'gynecological_surgery_history' => $this->gynecological_surgery_history,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
