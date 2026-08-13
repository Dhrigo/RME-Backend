<?php

namespace Modules\InventoryPharmacyPackage\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyPackageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'package_code' => $this->package_code,
            'name' => $this->name,
            'pharmacy_service_room_id' => $this->pharmacy_service_room_id,
            'category' => $this->category,
            'price' => $this->price,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
