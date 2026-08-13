<?php

namespace Modules\InventoryStockOpname\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockOpnameResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ward_id' => $this->ward_id,
            'opname_date' => $this->opname_date?->toDateString(),
            'conducted_by' => $this->conducted_by,
            'status' => $this->status,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
