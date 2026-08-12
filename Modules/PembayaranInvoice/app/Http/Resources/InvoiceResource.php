<?php

namespace Modules\PembayaranInvoice\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'visit_id' => $this->visit_id,
            'invoice_date' => $this->invoice_date?->toIso8601String(),
            'subtotal' => $this->subtotal,
            'rounding_adjustment' => $this->rounding_adjustment,
            'total_amount' => $this->total_amount,
            'is_locked' => $this->is_locked,
            'created_by' => $this->created_by,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
