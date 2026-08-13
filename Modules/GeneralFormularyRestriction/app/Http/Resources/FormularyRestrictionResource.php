<?php

namespace Modules\GeneralFormularyRestriction\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormularyRestrictionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'drug_name' => $this->drug_name,
            'formulary_category' => $this->formulary_category,
            'requires_substitution' => $this->requires_substitution,
            'substitution_drug_name' => $this->substitution_drug_name,
            'notes' => $this->notes,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
