<?php

namespace Modules\MedicalRecordInterventionProtocol\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterventionProtocolResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'started_by' => $this->started_by,
            'created_by' => $this->created_by,
            'protocol_name' => $this->protocol_name,
            'indication' => $this->indication,
            'status' => $this->status,
            'started_at' => $this->started_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
