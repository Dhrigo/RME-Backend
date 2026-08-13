<?php

namespace Modules\MedicalRecordChestExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChestExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'inspection' => $this->inspection,
            'palpation' => $this->palpation,
            'percussion' => $this->percussion,
            'auscultation_breath_sounds' => $this->auscultation_breath_sounds,
            'auscultation_heart_sounds' => $this->auscultation_heart_sounds,
            'findings' => $this->findings,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
