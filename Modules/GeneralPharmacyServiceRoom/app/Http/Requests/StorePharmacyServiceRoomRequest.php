<?php

namespace Modules\GeneralPharmacyServiceRoom\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyServiceRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'service_type' => ['required', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
