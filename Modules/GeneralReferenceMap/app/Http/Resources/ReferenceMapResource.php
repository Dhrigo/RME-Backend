<?php

namespace Modules\GeneralReferenceMap\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferenceMapResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'source_system' => $this->source_system,
            'source_code' => $this->source_code,
            'target_category' => $this->target_category,
            'target_code' => $this->target_code,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
