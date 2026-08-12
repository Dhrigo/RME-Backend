<?php

namespace Modules\MedicalRecordTriage\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TriageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'level' => $this->level,
            'chief_complaint' => $this->chief_complaint,
            'assessed_by' => $this->assessed_by,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'notes' => $this->notes,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
