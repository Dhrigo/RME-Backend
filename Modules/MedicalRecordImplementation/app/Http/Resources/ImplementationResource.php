<?php

namespace Modules\MedicalRecordImplementation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImplementationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'order_reference' => $this->order_reference,
            'description' => $this->description,
            'performed_by' => $this->performed_by,
            'performed_at' => $this->performed_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
