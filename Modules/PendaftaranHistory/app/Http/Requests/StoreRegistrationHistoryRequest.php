<?php

namespace Modules\PendaftaranHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'registration_id' => ['required', 'integer', 'exists:registrations,id'],
            'old_status' => ['nullable', 'string', 'max:255'],
            'new_status' => ['required', 'string', 'max:255'],
            'changed_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
