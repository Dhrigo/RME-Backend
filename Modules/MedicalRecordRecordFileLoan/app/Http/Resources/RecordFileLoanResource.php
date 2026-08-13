<?php

namespace Modules\MedicalRecordRecordFileLoan\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecordFileLoanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'borrower_name' => $this->borrower_name,
            'borrower_unit' => $this->borrower_unit,
            'purpose' => $this->purpose,
            'loaned_at' => $this->loaned_at?->toIso8601String(),
            'due_at' => $this->due_at?->toIso8601String(),
            'returned_at' => $this->returned_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
