<?php

namespace Modules\LayananCriticalLabValue\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CriticalLabValueResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lab_order_id' => $this->lab_order_id,
            'parameter_name' => $this->parameter_name,
            'critical_value' => $this->critical_value,
            'notified_to' => $this->notified_to,
            'notified_at' => $this->notified_at?->toIso8601String(),
            'acknowledged' => $this->acknowledged,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
