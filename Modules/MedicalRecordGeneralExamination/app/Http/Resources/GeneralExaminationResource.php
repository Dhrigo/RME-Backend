<?php

namespace Modules\MedicalRecordGeneralExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'general_appearance' => $this->general_appearance,
            'consciousness_level' => $this->consciousness_level,
            'nutritional_status' => $this->nutritional_status,
            'posture' => $this->posture,
            'gait' => $this->gait,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
