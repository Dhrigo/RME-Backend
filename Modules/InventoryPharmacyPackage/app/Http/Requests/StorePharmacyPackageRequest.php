<?php

namespace Modules\InventoryPharmacyPackage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyPackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'package_code' => ['required', 'string', 'max:255', 'unique:pharmacy_packages,package_code'],
            'name' => ['required', 'string', 'max:255'],
            'pharmacy_service_room_id' => ['nullable', 'integer', 'exists:pharmacy_service_rooms,id'],
            'category' => ['required', 'string', 'in:obat,alkes,campuran'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
