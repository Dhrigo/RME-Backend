<?php

namespace Modules\GeneralDoctorMedicalDepartment\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorMedicalDepartmentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'doctor_id' => $this->doctor_id,
            'medical_department_id' => $this->medical_department_id,
            'is_head' => $this->is_head,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
