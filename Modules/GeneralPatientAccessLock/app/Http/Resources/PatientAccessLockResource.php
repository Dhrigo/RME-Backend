<?php

namespace Modules\GeneralPatientAccessLock\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientAccessLockResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'locked_by' => $this->locked_by,
            'reason' => $this->reason,
            'locked_at' => $this->locked_at?->toIso8601String(),
            'unlocked_at' => $this->unlocked_at?->toIso8601String(),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
