<?php

namespace Modules\MedicalRecordEarExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EarExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'side' => $this->side,
            'otoscopy' => $this->otoscopy,
            'tympanic_membrane' => $this->tympanic_membrane,
            'hearing_test_result' => $this->hearing_test_result,
            'discharge' => $this->discharge,
            'findings' => $this->findings,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
