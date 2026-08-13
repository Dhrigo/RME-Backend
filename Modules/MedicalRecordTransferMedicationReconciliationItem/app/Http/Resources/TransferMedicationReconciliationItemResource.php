<?php

namespace Modules\MedicalRecordTransferMedicationReconciliationItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferMedicationReconciliationItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reconciliation_id' => $this->reconciliation_id,
            'drug_name' => $this->drug_name,
            'dose' => $this->dose,
            'frequency' => $this->frequency,
            'route' => $this->route,
            'action' => $this->action,
            'reason' => $this->reason,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
