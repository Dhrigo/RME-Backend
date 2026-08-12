<?php

namespace Modules\PendaftaranGuarantor\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuarantorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'registration_id' => $this->registration_id,
            'payer_type' => $this->payer_type,
            'member_number' => $this->member_number,
            'room_class_id' => $this->room_class_id,
            'reference_letter_number' => $this->reference_letter_number,
            'notes' => $this->notes,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
