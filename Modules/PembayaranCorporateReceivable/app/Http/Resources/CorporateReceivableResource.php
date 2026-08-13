<?php

namespace Modules\PembayaranCorporateReceivable\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CorporateReceivableResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_id' => $this->invoice_id,
            'guarantor_id' => $this->guarantor_id,
            'amount' => $this->amount,
            'due_date' => $this->due_date?->toDateString(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
