<?php

namespace Modules\GeneralPharmacyServiceRoom\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePharmacyServiceRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_type' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
