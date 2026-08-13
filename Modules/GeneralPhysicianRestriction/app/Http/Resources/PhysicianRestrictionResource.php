<?php

namespace Modules\GeneralPhysicianRestriction\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhysicianRestrictionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'doctor_id' => $this->doctor_id,
            'restricted_antibiotic_name' => $this->restricted_antibiotic_name,
            'authorization_level' => $this->authorization_level,
            'is_authorized_prescriber' => $this->is_authorized_prescriber,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
