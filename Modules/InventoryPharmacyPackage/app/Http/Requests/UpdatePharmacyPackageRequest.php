<?php

namespace Modules\InventoryPharmacyPackage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePharmacyPackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'package_code' => ['sometimes', 'string', 'max:255', Rule::unique('pharmacy_packages', 'package_code')->ignore($this->route('pharmacy_package'))],
            'name' => ['sometimes', 'string', 'max:255'],
            'pharmacy_service_room_id' => ['nullable', 'integer', 'exists:pharmacy_service_rooms,id'],
            'category' => ['sometimes', 'string', 'in:obat,alkes,campuran'],
            'price' => ['sometimes', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
