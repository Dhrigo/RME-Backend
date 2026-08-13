<?php

namespace Modules\MedicalRecordBackExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BackExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'spine_alignment' => $this->spine_alignment,
            'scoliosis' => $this->scoliosis,
            'kyphosis' => $this->kyphosis,
            'lordosis' => $this->lordosis,
            'tenderness' => $this->tenderness,
            'findings' => $this->findings,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
