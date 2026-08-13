<?php

namespace Modules\MedicalRecordBaepStimulationProtocolDetail\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaepStimulationProtocolDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'baep_protocol_id' => $this->baep_protocol_id,
            'stimulation_site' => $this->stimulation_site,
            'stimulation_frequency_hz' => $this->stimulation_frequency_hz,
            'stimulation_duration_minutes' => $this->stimulation_duration_minutes,
            'intensity_ma' => $this->intensity_ma,
            'number_of_sessions' => $this->number_of_sessions,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
