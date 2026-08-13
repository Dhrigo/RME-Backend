<?php

namespace Modules\LayananLabSensitivityResult\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabSensitivityResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lab_order_id' => $this->lab_order_id,
            'organism' => $this->organism,
            'antibiotic_name' => $this->antibiotic_name,
            'sensitivity_result' => $this->sensitivity_result,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
