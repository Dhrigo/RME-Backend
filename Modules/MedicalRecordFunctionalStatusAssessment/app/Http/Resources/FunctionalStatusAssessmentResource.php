<?php

namespace Modules\MedicalRecordFunctionalStatusAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FunctionalStatusAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'assessed_by' => $this->assessed_by,
            'created_by' => $this->created_by,
            'bathing_status' => $this->bathing_status,
            'dressing_status' => $this->dressing_status,
            'toileting_status' => $this->toileting_status,
            'transferring_status' => $this->transferring_status,
            'feeding_status' => $this->feeding_status,
            'total_score' => $this->total_score,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
