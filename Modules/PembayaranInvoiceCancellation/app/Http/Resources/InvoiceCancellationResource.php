<?php

namespace Modules\PembayaranInvoiceCancellation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceCancellationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_id' => $this->invoice_id,
            'cancelled_at' => $this->cancelled_at?->toIso8601String(),
            'cancelled_by' => $this->cancelled_by,
            'reason' => $this->reason,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
