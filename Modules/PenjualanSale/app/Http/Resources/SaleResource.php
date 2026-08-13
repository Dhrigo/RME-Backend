<?php

namespace Modules\PenjualanSale\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sale_number' => $this->sale_number,
            'patient_id' => $this->patient_id,
            'sold_by' => $this->sold_by,
            'sold_at' => $this->sold_at?->toIso8601String(),
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
