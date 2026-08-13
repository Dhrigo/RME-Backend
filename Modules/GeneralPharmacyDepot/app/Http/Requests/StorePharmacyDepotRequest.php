<?php

namespace Modules\GeneralPharmacyDepot\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyDepotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:255', 'unique:pharmacy_depots,code'],
            'name' => ['required', 'string', 'max:255'],
            'ward_id' => ['nullable', 'integer', 'exists:wards,id'],
            'phone' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
