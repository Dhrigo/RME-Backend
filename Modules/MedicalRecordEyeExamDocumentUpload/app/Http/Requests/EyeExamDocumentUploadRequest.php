<?php

namespace Modules\MedicalRecordEyeExamDocumentUpload\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EyeExamDocumentUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'doctor_id' => ['nullable', 'integer', 'exists:doctors,id'],
            'exam_date' => ['required', 'date'],
            'file_path' => ['required', 'string', 'max:255'],
            'eye_side' => ['nullable', 'string', 'max:50'],
            'findings' => ['nullable', 'string'],
        ];
    }
}
