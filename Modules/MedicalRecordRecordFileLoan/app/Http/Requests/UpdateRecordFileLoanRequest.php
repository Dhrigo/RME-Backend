<?php

namespace Modules\MedicalRecordRecordFileLoan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecordFileLoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => 'sometimes|required|integer',
            'borrower_name' => 'sometimes|required|string|max:150',
            'borrower_unit' => 'nullable|string|max:150',
            'purpose' => 'nullable|string|max:200',
            'loaned_at' => 'sometimes|required|date',
            'due_at' => 'nullable|date',
            'returned_at' => 'nullable|date',
            'status' => 'nullable|string|in:borrowed,returned,overdue',
        ];
    }
}
