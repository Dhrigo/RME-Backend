<?php

namespace Modules\MedicalRecordUpperGiTractExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpperGiTractExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'procedure_type' => $this->procedure_type,
            'esophagus_findings' => $this->esophagus_findings,
            'stomach_findings' => $this->stomach_findings,
            'duodenum_findings' => $this->duodenum_findings,
            'hpylori_result' => $this->hpylori_result,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
