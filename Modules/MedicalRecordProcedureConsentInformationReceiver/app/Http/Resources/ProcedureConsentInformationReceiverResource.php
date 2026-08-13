<?php

namespace Modules\MedicalRecordProcedureConsentInformationReceiver\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureConsentInformationReceiverResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'consent_id' => $this->consent_id,
            'receiver_name' => $this->receiver_name,
            'receiver_relationship' => $this->receiver_relationship,
            'signed_at' => $this->signed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
