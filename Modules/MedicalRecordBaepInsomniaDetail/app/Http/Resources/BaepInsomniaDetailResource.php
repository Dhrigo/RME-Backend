<?php

namespace Modules\MedicalRecordBaepInsomniaDetail\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaepInsomniaDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'baep_protocol_id' => $this->baep_protocol_id,
            'scale_used' => $this->scale_used,
            'score' => $this->score,
            'sleep_onset_latency_minutes' => $this->sleep_onset_latency_minutes,
            'sleep_efficiency_percent' => $this->sleep_efficiency_percent,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
