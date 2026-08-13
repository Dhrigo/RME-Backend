<?php

namespace Modules\LayananRadiologyResult\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RadiologyResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'radiology_order_id' => $this->radiology_order_id,
            'findings' => $this->findings,
            'impression' => $this->impression,
            'radiologist_id' => $this->radiologist_id,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
