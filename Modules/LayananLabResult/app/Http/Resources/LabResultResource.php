<?php

namespace Modules\LayananLabResult\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lab_order_id' => $this->lab_order_id,
            'test_name' => $this->test_name,
            'result_value' => $this->result_value,
            'normal_range' => $this->normal_range,
            'unit' => $this->unit,
            'is_abnormal' => $this->is_abnormal,
            'notes' => $this->notes,
            'recorded_at' => $this->recorded_at?->toIso8601String(),
            'recorded_by' => $this->recorded_by,
            'status' => $this->status,
        ];
    }
}
