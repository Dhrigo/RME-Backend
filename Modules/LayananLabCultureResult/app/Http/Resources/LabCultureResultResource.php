<?php

namespace Modules\LayananLabCultureResult\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabCultureResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lab_order_id' => $this->lab_order_id,
            'specimen_type' => $this->specimen_type,
            'organism_found' => $this->organism_found,
            'colony_count' => $this->colony_count,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'result_status' => $this->result_status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
