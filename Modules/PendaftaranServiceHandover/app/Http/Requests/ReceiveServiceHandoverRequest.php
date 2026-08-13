<?php

namespace Modules\PendaftaranServiceHandover\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReceiveServiceHandoverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(['received', 'rejected'])],
            'received_by' => ['required_if:status,received', 'integer', 'exists:employees,id'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
