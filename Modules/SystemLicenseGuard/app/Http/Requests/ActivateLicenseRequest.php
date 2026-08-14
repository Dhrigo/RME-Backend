<?php

namespace Modules\SystemLicenseGuard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivateLicenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'license_token' => 'required_without:license_key|string',
            'license_key' => 'required_without:license_token|string',
            'central_hub_url' => 'nullable|url',
        ];
    }
}
