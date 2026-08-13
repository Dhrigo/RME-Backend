<?php

namespace Modules\GeneralExaminationGroupMapping\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExaminationGroupMappingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'examination_group_id' => $this->examination_group_id,
            'mapping_category' => $this->mapping_category,
            'external_code' => $this->external_code,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
