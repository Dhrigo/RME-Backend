<?php

namespace Modules\MedicalRecordAbdomenExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AbdomenExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'inspection' => $this->inspection,
            'auscultation_bowel_sounds' => $this->auscultation_bowel_sounds,
            'palpation' => $this->palpation,
            'percussion' => $this->percussion,
            'tenderness' => $this->tenderness,
            'distension' => $this->distension,
            'liver_span_cm' => $this->liver_span_cm,
            'findings' => $this->findings,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
