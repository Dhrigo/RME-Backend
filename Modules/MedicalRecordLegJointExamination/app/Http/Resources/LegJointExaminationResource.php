<?php

namespace Modules\MedicalRecordLegJointExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LegJointExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'joint' => $this->joint,
            'range_of_motion' => $this->range_of_motion,
            'swelling' => $this->swelling,
            'tenderness' => $this->tenderness,
            'deformity' => $this->deformity,
            'findings' => $this->findings,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
