<?php

namespace Modules\LayananLeftoverMedicationVoucher\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeftoverMedicationVoucherResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'voucher_number' => $this->voucher_number,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'prescription_id' => $this->prescription_id,
            'status' => $this->status,
            'issued_at' => $this->issued_at?->toIso8601String(),
            'redeemed_at' => $this->redeemed_at?->toIso8601String(),
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
