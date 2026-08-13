<?php

namespace Modules\GeneralPatientAccessLock\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientAccessLockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'locked_by' => ['nullable', 'integer', 'exists:employees,id'],
            'reason' => ['required', 'string'],
            'locked_at' => ['nullable', 'date'],
        ];
    }
}
