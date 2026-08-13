<?php

namespace Modules\PembayaranInvoiceMerge\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceMergeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'merge_number' => $this->merge_number,
            'payment_id' => $this->payment_id,
            'invoice_id' => $this->invoice_id,
            'allocated_amount' => $this->allocated_amount,
            'merged_by' => $this->merged_by,
            'merged_at' => $this->merged_at?->toIso8601String(),
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
