<?php

namespace Modules\PembayaranInvoiceGuarantor\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceGuarantorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_id' => $this->invoice_id,
            'guarantor_id' => $this->guarantor_id,
            'covered_amount' => $this->covered_amount,
            'coverage_percentage' => $this->coverage_percentage,
            'verification_status' => $this->verification_status,
            'verified_by' => $this->verified_by,
            'verified_at' => $this->verified_at?->toIso8601String(),
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
