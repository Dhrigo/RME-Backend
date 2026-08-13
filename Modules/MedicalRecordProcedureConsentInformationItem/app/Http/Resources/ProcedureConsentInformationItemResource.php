<?php

namespace Modules\MedicalRecordProcedureConsentInformationItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureConsentInformationItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'information_id' => $this->information_id,
            'item_name' => $this->item_name,
            'is_explained' => $this->is_explained,
            'is_understood' => $this->is_understood,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
