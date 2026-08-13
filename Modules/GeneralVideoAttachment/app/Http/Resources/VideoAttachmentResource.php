<?php

namespace Modules\GeneralVideoAttachment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoAttachmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'visit_id' => $this->visit_id,
            'title' => $this->title,
            'file_path' => $this->file_path,
            'mime_type' => $this->mime_type,
            'duration_seconds' => $this->duration_seconds,
            'recorded_by' => $this->recorded_by,
            'notes' => $this->notes,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
