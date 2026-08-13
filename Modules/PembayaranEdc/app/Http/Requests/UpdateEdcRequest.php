<?php

namespace Modules\PembayaranEdc\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEdcRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(['approved', 'declined'])],
            'approval_code' => ['nullable', 'string', 'max:255'],
        ];
    }
}
