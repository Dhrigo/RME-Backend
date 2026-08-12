<?php

namespace Modules\GeneralEmployee\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'employee_number' => $this->employee_number,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'title_prefix' => $this->title_prefix,
            'title_suffix' => $this->title_suffix,
            'birth_place' => $this->birth_place,
            'birth_date' => $this->birth_date?->toDateString(),
            'religion_id' => $this->religion_id,
            'gender_id' => $this->gender_id,
            'profession_id' => $this->profession_id,
            'smf_id' => $this->smf_id,
            'address' => $this->address,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'postal_code' => $this->postal_code,
            'region_code' => $this->region_code,
            'is_non_employee' => $this->is_non_employee,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
