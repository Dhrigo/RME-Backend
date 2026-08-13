<?php

namespace Modules\MedicalRecordProcedureSurgery\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureSurgeryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'procedure_id' => $this->procedure_id,
            'surgery_name' => $this->surgery_name,
            'surgery_type' => $this->surgery_type,
            'anesthesia_type' => $this->anesthesia_type,
            'performed_at' => $this->performed_at?->toIso8601String(),
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
