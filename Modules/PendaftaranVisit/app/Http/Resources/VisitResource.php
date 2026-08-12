<?php

namespace Modules\PendaftaranVisit\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_number' => $this->visit_number,
            'registration_id' => $this->registration_id,
            'attending_physician_id' => $this->attending_physician_id,
            'room_id' => $this->room_id,
            'bed_id' => $this->bed_id,
            'admitted_at' => $this->admitted_at?->toIso8601String(),
            'discharged_at' => $this->discharged_at?->toIso8601String(),
            'is_new_visit' => $this->is_new_visit,
            'is_deposit' => $this->is_deposit,
            'deposit_class_id' => $this->deposit_class_id,
            'received_by' => $this->received_by,
            'final_outcome' => $this->final_outcome,
            'final_outcome_by' => $this->final_outcome_by,
            'final_outcome_at' => $this->final_outcome_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
