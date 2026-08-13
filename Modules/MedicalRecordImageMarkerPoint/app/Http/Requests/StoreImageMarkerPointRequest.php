<?php

namespace Modules\MedicalRecordImageMarkerPoint\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageMarkerPointRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image_marker_id' => 'required|integer',
            'x_coordinate' => 'required|numeric',
            'y_coordinate' => 'required|numeric',
            'label' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ];
    }
}
