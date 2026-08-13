<?php

namespace Modules\InventoryWardStockTransaction\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WardStockTransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ward_id' => $this->ward_id,
            'item_id' => $this->item_id,
            'type' => $this->type,
            'quantity' => $this->quantity,
            'performed_by' => $this->performed_by,
            'performed_at' => $this->performed_at?->toIso8601String(),
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
