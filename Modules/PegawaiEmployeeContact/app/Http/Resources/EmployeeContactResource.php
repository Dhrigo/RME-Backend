<?php

namespace Modules\PegawaiEmployeeContact\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'contact_type' => $this->contact_type,
            'value' => $this->value,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
