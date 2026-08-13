<?php

namespace Modules\PegawaiEmployeeIdentityCard\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeIdentityCardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'id_type' => $this->id_type,
            'id_number' => $this->id_number,
            'issued_at' => $this->issued_at?->toDateString(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
