<?php

namespace Modules\MedicalRecordProcedureConsentInformationGiver\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureConsentInformationGiverResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'consent_id' => $this->consent_id,
            'giver_id' => $this->giver_id,
            'giver_role' => $this->giver_role,
            'signed_at' => $this->signed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
