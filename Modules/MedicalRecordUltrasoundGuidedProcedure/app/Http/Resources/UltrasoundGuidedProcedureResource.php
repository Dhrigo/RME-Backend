<?php

namespace Modules\MedicalRecordUltrasoundGuidedProcedure\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UltrasoundGuidedProcedureResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'visit_id' => $this->visit_id,
            'doctor_id' => $this->doctor_id,
            'procedure_name' => $this->procedure_name,
            'target_site' => $this->target_site,
            'needle_gauge' => $this->needle_gauge,
            'findings_and_outcome' => $this->findings_and_outcome,
            'complications' => $this->complications,
            'performed_at' => $this->performed_at?->toISOString(),
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
