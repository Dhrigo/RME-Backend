<?php

namespace Modules\MedicalRecordDocumentUpload\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_id' => ['nullable', 'integer', 'exists:visits,id'],
            'document_name' => ['required', 'string', 'max:255'],
            'document_type' => ['nullable', 'string', 'max:100'],
            'file_path' => ['required', 'string', 'max:255'],
            'file_size_bytes' => ['nullable', 'integer', 'min:0'],
            'uploaded_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
