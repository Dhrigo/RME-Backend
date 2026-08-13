<?php

namespace Modules\MedicalRecordLabResultSummaryItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabResultSummaryItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'summary_id' => $this->summary_id,
            'lab_test_name' => $this->lab_test_name,
            'result_value' => $this->result_value,
            'unit' => $this->unit,
            'reference_range' => $this->reference_range,
            'flag' => $this->flag,
            'tested_at' => $this->tested_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
