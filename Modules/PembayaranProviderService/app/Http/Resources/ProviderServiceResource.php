<?php

namespace Modules\PembayaranProviderService\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'payment_provider_id' => $this->payment_provider_id,
            'service_code' => $this->service_code,
            'service_name' => $this->service_name,
            'service_type' => $this->service_type,
            'admin_fee_type' => $this->admin_fee_type,
            'admin_fee_amount' => $this->admin_fee_amount,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
