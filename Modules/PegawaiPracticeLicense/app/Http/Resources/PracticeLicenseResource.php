<?php

namespace Modules\PegawaiPracticeLicense\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PracticeLicenseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'license_type' => $this->license_type,
            'license_number' => $this->license_number,
            'issued_at' => $this->issued_at?->toDateString(),
            'expires_at' => $this->expires_at?->toDateString(),
            'issuing_authority' => $this->issuing_authority,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
