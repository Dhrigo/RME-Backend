<?php

namespace Modules\LayananPathologyImmunofluorescenceResult\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PathologyImmunofluorescenceResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pathology_anatomy_result_id' => $this->pathology_anatomy_result_id,
            'marker' => $this->marker,
            'result' => $this->result,
            'intensity' => $this->intensity,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
