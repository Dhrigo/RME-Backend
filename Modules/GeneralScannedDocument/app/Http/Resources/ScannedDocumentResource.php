<?php

namespace Modules\GeneralScannedDocument\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScannedDocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'document_type' => $this->document_type,
            'file_path' => $this->file_path,
            'scanned_at' => $this->scanned_at?->toIso8601String(),
            'scanned_by' => $this->scanned_by,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
