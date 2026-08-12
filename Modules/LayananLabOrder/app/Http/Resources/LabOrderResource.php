<?php

namespace Modules\LayananLabOrder\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabOrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'visit_id' => $this->visit_id,
            'ordered_by' => $this->ordered_by,
            'ordered_at' => $this->ordered_at?->toIso8601String(),
            'destination' => $this->destination,
            'is_emergency' => $this->is_emergency,
            'reason' => $this->reason,
            'notes' => $this->notes,
            'status' => $this->status,
            'results' => $this->whenLoaded('results', fn () => $this->results->map(fn ($r) => [
                'id' => $r->id,
                'test_name' => $r->test_name,
                'result_value' => $r->result_value,
                'normal_range' => $r->normal_range,
                'unit' => $r->unit,
                'is_abnormal' => $r->is_abnormal,
            ])),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
