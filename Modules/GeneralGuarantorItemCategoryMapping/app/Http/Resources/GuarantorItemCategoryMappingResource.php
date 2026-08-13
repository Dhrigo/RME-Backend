<?php

namespace Modules\GeneralGuarantorItemCategoryMapping\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuarantorItemCategoryMappingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'guarantor_id' => $this->guarantor_id,
            'item_category_id' => $this->item_category_id,
            'is_covered' => $this->is_covered,
            'coverage_percentage' => $this->coverage_percentage,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
