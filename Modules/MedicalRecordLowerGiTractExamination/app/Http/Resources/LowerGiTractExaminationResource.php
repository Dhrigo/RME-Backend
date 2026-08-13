<?php

namespace Modules\MedicalRecordLowerGiTractExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LowerGiTractExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'procedure_type' => $this->procedure_type,
            'colon_findings' => $this->colon_findings,
            'rectum_findings' => $this->rectum_findings,
            'polyps_found' => $this->polyps_found,
            'biopsy_taken' => $this->biopsy_taken,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
