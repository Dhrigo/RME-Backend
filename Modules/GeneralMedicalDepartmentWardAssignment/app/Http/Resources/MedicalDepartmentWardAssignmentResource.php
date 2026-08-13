<?php

namespace Modules\GeneralMedicalDepartmentWardAssignment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicalDepartmentWardAssignmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'medical_department_id' => $this->medical_department_id,
            'ward_id' => $this->ward_id,
            'is_primary' => $this->is_primary,
            'assigned_at' => $this->assigned_at?->toDateString(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
