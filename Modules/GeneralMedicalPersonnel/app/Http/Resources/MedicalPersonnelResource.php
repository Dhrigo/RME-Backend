<?php

namespace Modules\GeneralMedicalPersonnel\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicalPersonnelResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'identity_number' => $this->identity_number,
            'name' => $this->name,
            'personnel_type' => $this->personnel_type,
            'profession_id' => $this->profession_id,
            'license_number' => $this->license_number,
            'phone' => $this->phone,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
