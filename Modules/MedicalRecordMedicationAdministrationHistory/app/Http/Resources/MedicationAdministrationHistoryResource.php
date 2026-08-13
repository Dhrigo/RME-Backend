<?php

namespace Modules\MedicalRecordMedicationAdministrationHistory\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicationAdministrationHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'administered_by' => $this->administered_by,
            'created_by' => $this->created_by,
            'drug_name' => $this->drug_name,
            'dose' => $this->dose,
            'route' => $this->route,
            'administered_at' => $this->administered_at?->toIso8601String(),
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
