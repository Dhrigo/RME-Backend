<?php

namespace Modules\LayananLabMicroscopicResultItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabMicroscopicResultItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lab_microscopic_result_id' => $this->lab_microscopic_result_id,
            'parameter_name' => $this->parameter_name,
            'value' => $this->value,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
