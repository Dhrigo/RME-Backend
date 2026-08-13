<?php

namespace Modules\MedicalRecordEmgExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmgExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'nerve_conduction_velocity' => $this->nerve_conduction_velocity,
            'spontaneous_activity' => $this->spontaneous_activity,
            'motor_unit_potentials' => $this->motor_unit_potentials,
            'recruitment_pattern' => $this->recruitment_pattern,
            'conclusion' => $this->conclusion,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
