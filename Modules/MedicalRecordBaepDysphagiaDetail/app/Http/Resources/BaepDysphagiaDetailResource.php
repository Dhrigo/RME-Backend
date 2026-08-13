<?php

namespace Modules\MedicalRecordBaepDysphagiaDetail\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaepDysphagiaDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'baep_protocol_id' => $this->baep_protocol_id,
            'swallowing_test_used' => $this->swallowing_test_used,
            'severity_level' => $this->severity_level,
            'aspiration_risk' => $this->aspiration_risk,
            'diet_texture_recommendation' => $this->diet_texture_recommendation,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
