<?php

namespace Modules\GeneralDoctorWardAssignment\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorWardAssignmentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'doctor_id' => $this->doctor_id,
            'ward_id' => $this->ward_id,
            'assigned_at' => $this->assigned_at,
            'schedule_day' => $this->schedule_day,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
