<?php

namespace Modules\MedicalRecordTbDiseaseHistory\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TbDiseaseHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'created_by' => $this->created_by,
            'previous_tb_treatment' => $this->previous_tb_treatment,
            'treatment_year' => $this->treatment_year,
            'treatment_outcome' => $this->treatment_outcome,
            'tb_category' => $this->tb_category,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
