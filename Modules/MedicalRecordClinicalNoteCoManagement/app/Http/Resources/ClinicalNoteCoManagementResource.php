<?php

namespace Modules\MedicalRecordClinicalNoteCoManagement\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClinicalNoteCoManagementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'clinical_note_id' => $this->clinical_note_id,
            'medical_department_id' => $this->medical_department_id,
            'notes' => $this->notes,
            'author_id' => $this->author_id,
            'recorded_at' => $this->recorded_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
