<?php

namespace Modules\MedicalRecordRadiologyResultSummaryItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RadiologyResultSummaryItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'summary_id' => $this->summary_id,
            'exam_name' => $this->exam_name,
            'finding' => $this->finding,
            'impression' => $this->impression,
            'performed_at' => $this->performed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
