<?php

namespace Modules\GeneralNurseWardAssignment\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NurseWardAssignmentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'nurse_id' => $this->nurse_id,
            'ward_id' => $this->ward_id,
            'shift' => $this->shift,
            'assigned_at' => $this->assigned_at,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
