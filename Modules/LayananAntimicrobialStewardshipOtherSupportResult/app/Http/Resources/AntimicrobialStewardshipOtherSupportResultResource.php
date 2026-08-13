<?php

namespace Modules\LayananAntimicrobialStewardshipOtherSupportResult\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AntimicrobialStewardshipOtherSupportResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'antimicrobial_stewardship_form_id' => $this->antimicrobial_stewardship_form_id,
            'examination_name' => $this->examination_name,
            'result_value' => $this->result_value,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
