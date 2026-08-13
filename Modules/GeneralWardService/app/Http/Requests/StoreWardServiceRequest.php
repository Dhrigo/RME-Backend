<?php

namespace Modules\GeneralWardService\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWardServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
