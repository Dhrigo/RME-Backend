<?php

namespace Modules\LayananRadiologyOrderItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RadiologyOrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'radiology_order_id' => $this->radiology_order_id,
            'examination_name' => $this->examination_name,
            'body_part' => $this->body_part,
            'price' => $this->price,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
