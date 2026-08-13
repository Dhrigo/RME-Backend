<?php

namespace Modules\MedicalRecordDoctorProcedureConsent\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorProcedureConsentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'doctor_id' => $this->doctor_id,
            'created_by' => $this->created_by,
            'procedure_name' => $this->procedure_name,
            'indication' => $this->indication,
            'consent_decision' => $this->consent_decision,
            'signed_at' => $this->signed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
