<?php

namespace Modules\GeneralPrescriptionFrequencyRuleCategory\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionFrequencyRuleCategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'prescription_frequency_rule_id' => $this->prescription_frequency_rule_id,
            'category_name' => $this->category_name,
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
