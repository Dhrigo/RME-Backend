<?php

namespace Modules\MedicalRecordAnamnesisSource\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnamnesisSourceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'anamnesis_id' => $this->anamnesis_id,
            'source_type' => $this->source_type,
            'source_name' => $this->source_name,
            'relationship' => $this->relationship,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
