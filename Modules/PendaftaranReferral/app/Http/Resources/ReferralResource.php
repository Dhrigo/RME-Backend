<?php

namespace Modules\PendaftaranReferral\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferralResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'referral_number' => $this->referral_number,
            'patient_id' => $this->patient_id,
            'direction' => $this->direction,
            'facility_name' => $this->facility_name,
            'reason' => $this->reason,
            'referred_at' => $this->referred_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
