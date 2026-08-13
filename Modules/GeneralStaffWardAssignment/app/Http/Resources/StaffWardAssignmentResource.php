<?php

namespace Modules\GeneralStaffWardAssignment\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffWardAssignmentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'staff_member_id' => $this->staff_member_id,
            'ward_id' => $this->ward_id,
            'assigned_at' => $this->assigned_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
