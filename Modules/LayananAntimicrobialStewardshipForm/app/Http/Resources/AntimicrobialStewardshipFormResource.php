<?php

namespace Modules\LayananAntimicrobialStewardshipForm\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AntimicrobialStewardshipFormResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'requesting_doctor_id' => $this->requesting_doctor_id,
            'antibiotic_restriction_id' => $this->antibiotic_restriction_id,
            'indication' => $this->indication,
            'status' => $this->status,
            'submitted_at' => $this->submitted_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
