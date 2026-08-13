<?php

namespace Modules\GeneralWardService\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWardServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ward_id' => ['sometimes', 'integer', 'exists:wards,id'],
            'service_id' => ['sometimes', 'integer', 'exists:services,id'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
