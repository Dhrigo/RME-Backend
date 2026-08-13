<?php

namespace Modules\MedicalRecordProcedureConsentInformation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureConsentInformationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'consent_id' => $this->consent_id,
            'explained_by' => $this->explained_by,
            'diagnosis_explanation' => $this->diagnosis_explanation,
            'procedure_explanation' => $this->procedure_explanation,
            'purpose' => $this->purpose,
            'risks_and_complications' => $this->risks_and_complications,
            'alternative_procedures' => $this->alternative_procedures,
            'prognosis' => $this->prognosis,
            'explained_at' => $this->explained_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
