<?php

namespace Modules\MedicalRecordBaepSensoryDetail\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaepSensoryDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'baep_protocol_id' => $this->baep_protocol_id,
            'sensory_modality' => $this->sensory_modality,
            'sensory_score' => $this->sensory_score,
            'affected_region' => $this->affected_region,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
