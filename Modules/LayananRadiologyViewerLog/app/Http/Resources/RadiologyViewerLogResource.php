<?php

namespace Modules\LayananRadiologyViewerLog\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RadiologyViewerLogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'accession_number' => $this->accession_number,
            'viewed_by' => $this->viewed_by,
            'viewed_at' => $this->viewed_at?->toIso8601String(),
            'ip_address' => $this->ip_address,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
