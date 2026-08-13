<?php

namespace Modules\MedicalRecordImmunizationVaccination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImmunizationVaccinationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'visit_id' => $this->visit_id,
            'vaccine_name' => $this->vaccine_name,
            'dose_number' => $this->dose_number,
            'batch_number' => $this->batch_number,
            'administered_at' => $this->administered_at?->toIso8601String(),
            'administered_by' => $this->administered_by,
            'site' => $this->site,
            'route' => $this->route,
            'adverse_reaction' => $this->adverse_reaction,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
