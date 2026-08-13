<?php

namespace Modules\MedicalRecordPatientTransferSheet\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientTransferSheetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'from_ward_id' => $this->from_ward_id,
            'to_ward_id' => $this->to_ward_id,
            'transfer_reason' => $this->transfer_reason,
            'patient_condition' => $this->patient_condition,
            'transferred_at' => $this->transferred_at?->toIso8601String(),
            'transferred_by' => $this->transferred_by,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
