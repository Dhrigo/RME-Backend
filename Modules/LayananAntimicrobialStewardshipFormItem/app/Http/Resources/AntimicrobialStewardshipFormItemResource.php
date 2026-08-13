<?php

namespace Modules\LayananAntimicrobialStewardshipFormItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AntimicrobialStewardshipFormItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'antimicrobial_stewardship_form_id' => $this->antimicrobial_stewardship_form_id,
            'item_id' => $this->item_id,
            'dose' => $this->dose,
            'route' => $this->route,
            'frequency' => $this->frequency,
            'planned_duration_days' => $this->planned_duration_days,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
