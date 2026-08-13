<?php

namespace Modules\GeneralPackageTariffDistributionItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageTariffDistributionItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'package_tariff_distribution_id' => $this->package_tariff_distribution_id,
            'recipient_type' => $this->recipient_type,
            'recipient_id' => $this->recipient_id,
            'percentage' => $this->percentage,
            'amount' => $this->amount,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
