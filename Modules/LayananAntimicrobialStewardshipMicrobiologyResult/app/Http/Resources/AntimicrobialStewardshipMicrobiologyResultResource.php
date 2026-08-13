<?php

namespace Modules\LayananAntimicrobialStewardshipMicrobiologyResult\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AntimicrobialStewardshipMicrobiologyResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'antimicrobial_stewardship_form_id' => $this->antimicrobial_stewardship_form_id,
            'specimen_type' => $this->specimen_type,
            'organism_found' => $this->organism_found,
            'sensitivity_result' => $this->sensitivity_result,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
