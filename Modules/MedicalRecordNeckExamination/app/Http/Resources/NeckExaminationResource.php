<?php

namespace Modules\MedicalRecordNeckExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NeckExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'lymph_nodes' => $this->lymph_nodes,
            'thyroid' => $this->thyroid,
            'jugular_venous_pressure' => $this->jugular_venous_pressure,
            'trachea_position' => $this->trachea_position,
            'mass' => $this->mass,
            'findings' => $this->findings,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
