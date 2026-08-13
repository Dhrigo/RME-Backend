<?php

namespace Modules\GeneralAudioAttachment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAudioAttachmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['sometimes', 'integer', 'exists:patients,id'],
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'title' => ['sometimes', 'string', 'max:255'],
            'file_path' => ['sometimes', 'string', 'max:255'],
            'mime_type' => ['sometimes', 'string', 'max:255'],
            'duration_seconds' => ['sometimes', 'integer'],
            'recorded_by' => ['sometimes', 'integer', 'exists:users,id'],
            'notes' => ['sometimes', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
