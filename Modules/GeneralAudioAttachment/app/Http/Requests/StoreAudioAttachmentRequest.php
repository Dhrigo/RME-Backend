<?php

namespace Modules\GeneralAudioAttachment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAudioAttachmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['nullable', 'integer', 'exists:patients,id'],
            'visit_id' => ['nullable', 'integer', 'exists:visits,id'],
            'title' => ['required', 'string', 'max:255'],
            'file_path' => ['required', 'string', 'max:255'],
            'mime_type' => ['nullable', 'string', 'max:255'],
            'duration_seconds' => ['nullable', 'integer'],
            'recorded_by' => ['nullable', 'integer', 'exists:users,id'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
