<?php

namespace Modules\PembayaranTransfer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTransferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(['verified', 'rejected'])],
            'proof_file_path' => ['nullable', 'string', 'max:255'],
        ];
    }
}
