<?php

namespace Modules\MedicalRecordMedicalCheckupResult\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicalCheckupResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'visit_id' => $this->visit_id,
            'checkup_date' => $this->checkup_date?->toIso8601String(),
            'category' => $this->category,
            'summary' => $this->summary,
            'recommendation' => $this->recommendation,
            'examined_by' => $this->examined_by,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
