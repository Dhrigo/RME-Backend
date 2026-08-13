<?php

namespace Modules\MedicalRecordBaepMotorDetail\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaepMotorDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'baep_protocol_id' => $this->baep_protocol_id,
            'muscle_strength_score' => $this->muscle_strength_score,
            'spasticity_level' => $this->spasticity_level,
            'gait_status' => $this->gait_status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
