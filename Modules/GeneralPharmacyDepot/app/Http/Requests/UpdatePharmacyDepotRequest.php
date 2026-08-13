<?php

namespace Modules\GeneralPharmacyDepot\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePharmacyDepotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['sometimes', 'string', 'max:255', 'unique:pharmacy_depots,code'],
            'name' => ['sometimes', 'string', 'max:255'],
            'ward_id' => ['sometimes', 'integer', 'exists:wards,id'],
            'phone' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
