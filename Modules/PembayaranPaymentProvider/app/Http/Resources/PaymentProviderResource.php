<?php

namespace Modules\PembayaranPaymentProvider\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentProviderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'provider_code' => $this->provider_code,
            'provider_name' => $this->provider_name,
            'provider_type' => $this->provider_type,
            'merchant_id' => $this->merchant_id,
            'api_base_url' => $this->api_base_url,
            'contact_person' => $this->contact_person,
            'contact_phone' => $this->contact_phone,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
