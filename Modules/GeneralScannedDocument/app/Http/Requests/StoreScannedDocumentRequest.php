<?php

namespace Modules\GeneralScannedDocument\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScannedDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['nullable', 'integer', 'exists:patients,id'],
            'document_type' => ['required', 'string', 'max:255'],
            'file_path' => ['required', 'string', 'max:255'],
            'scanned_at' => ['required', 'date'],
            'scanned_by' => ['required', 'integer', 'exists:employees,id'],
        ];
    }
}
