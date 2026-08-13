<?php

namespace Modules\MedicalRecordBaepCognitiveDetail\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaepCognitiveDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'baep_protocol_id' => $this->baep_protocol_id,
            'scale_used' => $this->scale_used,
            'score' => $this->score,
            'domains_affected' => $this->domains_affected,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
