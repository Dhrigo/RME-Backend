<?php

namespace Modules\MedicalRecordEkgExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EkgExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'heart_rate_bpm' => $this->heart_rate_bpm,
            'rhythm' => $this->rhythm,
            'p_wave' => $this->p_wave,
            'pr_interval_ms' => $this->pr_interval_ms,
            'qrs_duration_ms' => $this->qrs_duration_ms,
            'st_segment' => $this->st_segment,
            't_wave' => $this->t_wave,
            'conclusion' => $this->conclusion,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
