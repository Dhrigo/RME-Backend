<?php

namespace Modules\MedicalRecordBaepDepressionDetail\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaepDepressionDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'baep_protocol_id' => $this->baep_protocol_id,
            'scale_used' => $this->scale_used,
            'score' => $this->score,
            'severity_level' => $this->severity_level,
            'symptoms_observed' => $this->symptoms_observed,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
