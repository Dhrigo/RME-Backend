<?php

namespace Modules\LayananLabOrderItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabOrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lab_order_id' => $this->lab_order_id,
            'examination_name' => $this->examination_name,
            'item_id' => $this->item_id,
            'price' => $this->price,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
