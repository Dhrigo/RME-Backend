<?php

namespace Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureConsentPatientAcknowledgementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'consent_id' => $this->consent_id,
            'acknowledger_name' => $this->acknowledger_name,
            'relationship_to_patient' => $this->relationship_to_patient,
            'decision' => $this->decision,
            'signed_at' => $this->signed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
