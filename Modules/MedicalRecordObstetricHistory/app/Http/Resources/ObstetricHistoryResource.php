<?php

namespace Modules\MedicalRecordObstetricHistory\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ObstetricHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'created_by' => $this->created_by,
            'pregnancy_number' => $this->pregnancy_number,
            'delivery_date' => $this->delivery_date?->toDateString(),
            'delivery_method' => $this->delivery_method,
            'birth_weight_grams' => $this->birth_weight_grams,
            'complications' => $this->complications,
            'outcome' => $this->outcome,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
