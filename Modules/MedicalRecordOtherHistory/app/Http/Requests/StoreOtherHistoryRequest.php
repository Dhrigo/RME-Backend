<?php

namespace Modules\MedicalRecordOtherHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOtherHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'recorded_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'category' => ['nullable','string','max:255'],
            'description' => ['required','string'],
            'recorded_at' => ['nullable','date'],
        ];
    }
}
