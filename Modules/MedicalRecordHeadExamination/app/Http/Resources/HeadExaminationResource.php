<?php

namespace Modules\MedicalRecordHeadExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeadExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'skull_shape' => $this->skull_shape,
            'hair_distribution' => $this->hair_distribution,
            'facial_symmetry' => $this->facial_symmetry,
            'tenderness' => $this->tenderness,
            'findings' => $this->findings,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
