<?php

namespace Modules\MedicalRecordDischargeSummary\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DischargeSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'admission_diagnosis_id' => $this->admission_diagnosis_id,
            'discharge_diagnosis_id' => $this->discharge_diagnosis_id,
            'treatment_summary' => $this->treatment_summary,
            'condition_at_discharge' => $this->condition_at_discharge,
            'follow_up_plan' => $this->follow_up_plan,
            'discharge_medication' => $this->discharge_medication,
            'authored_by' => $this->authored_by,
            'authored_at' => $this->authored_at?->toIso8601String(),
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
