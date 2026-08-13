<?php

namespace Modules\MedicalRecordPharynxExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharynxExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'mucosa_color' => $this->mucosa_color,
            'exudate' => (bool) $this->exudate,
            'post_nasal_drip' => (bool) $this->post_nasal_drip,
            'posterior_wall_condition' => $this->posterior_wall_condition,
            'notes' => $this->notes,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
