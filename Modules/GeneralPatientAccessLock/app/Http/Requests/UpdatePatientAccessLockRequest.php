<?php

namespace Modules\GeneralPatientAccessLock\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientAccessLockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reason' => ['sometimes', 'string'],
            'unlocked_at' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
