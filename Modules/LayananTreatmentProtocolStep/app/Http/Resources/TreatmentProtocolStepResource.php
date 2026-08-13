<?php

namespace Modules\LayananTreatmentProtocolStep\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentProtocolStepResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'treatment_protocol_id' => $this->treatment_protocol_id,
            'sequence' => $this->sequence,
            'instruction' => $this->instruction,
            'scheduled_at' => $this->scheduled_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
