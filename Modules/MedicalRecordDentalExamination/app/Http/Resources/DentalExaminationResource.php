<?php

namespace Modules\MedicalRecordDentalExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DentalExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'decayed_teeth_count' => $this->decayed_teeth_count,
            'missing_teeth_count' => $this->missing_teeth_count,
            'filled_teeth_count' => $this->filled_teeth_count,
            'odontogram_json' => $this->odontogram_json,
            'occlusion_status' => $this->occlusion_status,
            'notes' => $this->notes,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
