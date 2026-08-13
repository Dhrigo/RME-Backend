<?php

namespace Modules\MedicalRecordDocumentUpload\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentUploadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'visit_id' => $this->visit_id,
            'document_name' => $this->document_name,
            'document_type' => $this->document_type,
            'file_path' => $this->file_path,
            'file_size_bytes' => $this->file_size_bytes,
            'uploaded_at' => $this->uploaded_at?->toISOString(),
            'notes' => $this->notes,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
