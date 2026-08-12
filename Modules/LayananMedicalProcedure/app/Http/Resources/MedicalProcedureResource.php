<?php

namespace Modules\LayananMedicalProcedure\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicalProcedureResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'service_id' => $this->service_id,
            'performed_at' => $this->performed_at?->toIso8601String(),
            'performed_by' => $this->performed_by,
            'notes' => $this->notes,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
