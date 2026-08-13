<?php

namespace Modules\LayananLabPcrResult\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabPcrResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lab_order_id' => $this->lab_order_id,
            'target_gene' => $this->target_gene,
            'result' => $this->result,
            'ct_value' => $this->ct_value,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
