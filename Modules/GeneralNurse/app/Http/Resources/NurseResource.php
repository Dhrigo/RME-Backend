<?php

namespace Modules\GeneralNurse\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NurseResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'nurse_license_number' => $this->nurse_license_number,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
