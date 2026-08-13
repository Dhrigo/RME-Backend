<?php

namespace Modules\GeneralOtherServiceTariff\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OtherServiceTariffResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'other_service_id' => $this->other_service_id,
            'room_class_id' => $this->room_class_id,
            'price' => $this->price,
            'effective_date' => $this->effective_date?->toDateString(),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
