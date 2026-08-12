<?php

namespace Modules\GeneralServiceTariff\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceTariffResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'service_id' => $this->service_id,
            'room_class_id' => $this->room_class_id,
            'price' => $this->price,
            'effective_date' => $this->effective_date?->toDateString(),
            'decree_number' => $this->decree_number,
            'decree_date' => $this->decree_date?->toDateString(),
            'created_by' => $this->created_by,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
