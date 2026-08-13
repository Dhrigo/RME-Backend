<?php

namespace Modules\GeneralAntibioticRestriction\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AntibioticRestrictionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'antibiotic_name' => $this->antibiotic_name,
            'aware_category' => $this->aware_category,
            'requires_pra_approval' => $this->requires_pra_approval,
            'restriction_condition' => $this->restriction_condition,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
