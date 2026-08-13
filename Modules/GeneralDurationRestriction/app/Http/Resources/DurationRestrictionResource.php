<?php

namespace Modules\GeneralDurationRestriction\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DurationRestrictionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'antibiotic_name' => $this->antibiotic_name,
            'max_days' => $this->max_days,
            'min_days' => $this->min_days,
            'requires_reevaluation' => $this->requires_reevaluation,
            'notes' => $this->notes,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
