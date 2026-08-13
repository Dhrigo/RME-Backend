<?php

namespace Modules\MedicalRecordAnalExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnalExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'inspection' => $this->inspection,
            'palpation' => $this->palpation,
            'sphincter_tone' => $this->sphincter_tone,
            'rectal_toucher_findings' => $this->rectal_toucher_findings,
            'ampulla_recti' => $this->ampulla_recti,
            'findings' => $this->findings,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
