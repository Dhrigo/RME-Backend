<?php

namespace Modules\LayananLeftoverMedicationVoucherItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeftoverMedicationVoucherItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'leftover_medication_voucher_id' => $this->leftover_medication_voucher_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
