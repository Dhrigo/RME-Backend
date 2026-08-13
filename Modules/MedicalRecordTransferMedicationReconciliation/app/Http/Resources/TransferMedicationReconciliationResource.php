<?php

namespace Modules\MedicalRecordTransferMedicationReconciliation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferMedicationReconciliationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'reconciled_by' => $this->reconciled_by,
            'created_by' => $this->created_by,
            'transferred_to_ward_id' => $this->transferred_to_ward_id,
            'source_of_medication_list' => $this->source_of_medication_list,
            'notes' => $this->notes,
            'status' => $this->status,
            'reconciled_at' => $this->reconciled_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
