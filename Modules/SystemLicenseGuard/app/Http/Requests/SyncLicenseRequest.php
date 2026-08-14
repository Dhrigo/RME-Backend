<?php

namespace Modules\SystemLicenseGuard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SyncLicenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'force' => 'nullable|boolean',
        ];
    }
}
