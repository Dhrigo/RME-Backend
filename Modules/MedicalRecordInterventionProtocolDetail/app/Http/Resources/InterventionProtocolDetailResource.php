<?php

namespace Modules\MedicalRecordInterventionProtocolDetail\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterventionProtocolDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'protocol_id' => $this->protocol_id,
            'performed_by' => $this->performed_by,
            'step_number' => $this->step_number,
            'step_description' => $this->step_description,
            'result_notes' => $this->result_notes,
            'performed_at' => $this->performed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
