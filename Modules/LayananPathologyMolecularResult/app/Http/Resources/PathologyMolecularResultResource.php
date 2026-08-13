<?php

namespace Modules\LayananPathologyMolecularResult\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PathologyMolecularResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pathology_anatomy_result_id' => $this->pathology_anatomy_result_id,
            'test_name' => $this->test_name,
            'result' => $this->result,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
