<?php

namespace Modules\PembayaranCorporateReceivableSettlement\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CorporateReceivableSettlementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'corporate_receivable_id' => $this->corporate_receivable_id,
            'paid_amount' => $this->paid_amount,
            'paid_at' => $this->paid_at?->toIso8601String(),
            'received_by' => $this->received_by,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
