<?php

namespace Modules\MedicalRecordBaepInterventionProtocol\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaepInterventionProtocolResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'performed_by' => $this->performed_by,
            'created_by' => $this->created_by,
            'indication' => $this->indication,
            'stimulation_ear' => $this->stimulation_ear,
            'click_rate_hz' => $this->click_rate_hz,
            'stimulus_intensity_db' => $this->stimulus_intensity_db,
            'wave_i_latency_ms' => $this->wave_i_latency_ms,
            'wave_iii_latency_ms' => $this->wave_iii_latency_ms,
            'wave_v_latency_ms' => $this->wave_v_latency_ms,
            'interpretation' => $this->interpretation,
            'status' => $this->status,
            'performed_at' => $this->performed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
