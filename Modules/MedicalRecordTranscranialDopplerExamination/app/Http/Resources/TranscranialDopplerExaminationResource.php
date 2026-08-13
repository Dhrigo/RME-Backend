<?php

namespace Modules\MedicalRecordTranscranialDopplerExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TranscranialDopplerExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'indication' => $this->indication,
            'vessel' => $this->vessel,
            'mean_velocity_cm_s' => $this->mean_velocity_cm_s,
            'pulsatility_index' => $this->pulsatility_index,
            'findings' => $this->findings,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
