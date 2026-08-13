<?php

namespace Modules\MedicalRecordLabResultSummary\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabResultSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'summarized_by' => $this->summarized_by,
            'created_by' => $this->created_by,
            'overall_impression' => $this->overall_impression,
            'summarized_at' => $this->summarized_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
