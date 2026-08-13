<?php

namespace Modules\LayananPathologyAnatomyResult\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PathologyAnatomyResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'specimen_description' => $this->specimen_description,
            'macroscopic_finding' => $this->macroscopic_finding,
            'microscopic_finding' => $this->microscopic_finding,
            'diagnosis' => $this->diagnosis,
            'examined_by' => $this->examined_by,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
