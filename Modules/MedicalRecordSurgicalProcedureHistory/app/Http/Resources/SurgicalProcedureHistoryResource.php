<?php

namespace Modules\MedicalRecordSurgicalProcedureHistory\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurgicalProcedureHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'created_by' => $this->created_by,
            'procedure_name' => $this->procedure_name,
            'procedure_date' => $this->procedure_date?->toDateString(),
            'facility_name' => $this->facility_name,
            'surgeon_name' => $this->surgeon_name,
            'complications' => $this->complications,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
