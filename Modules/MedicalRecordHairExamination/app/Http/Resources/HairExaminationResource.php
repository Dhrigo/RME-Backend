<?php

namespace Modules\MedicalRecordHairExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HairExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'distribution' => $this->distribution,
            'texture' => $this->texture,
            'color' => $this->color,
            'hair_loss' => $this->hair_loss,
            'scalp_condition' => $this->scalp_condition,
            'findings' => $this->findings,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
