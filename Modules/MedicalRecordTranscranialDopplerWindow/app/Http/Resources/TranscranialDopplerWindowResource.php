<?php

namespace Modules\MedicalRecordTranscranialDopplerWindow\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TranscranialDopplerWindowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'transcranial_doppler_examination_id' => $this->transcranial_doppler_examination_id,
            'window_site' => $this->window_site,
            'signal_quality' => $this->signal_quality,
            'depth_mm' => $this->depth_mm,
            'velocity_cm_s' => $this->velocity_cm_s,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
