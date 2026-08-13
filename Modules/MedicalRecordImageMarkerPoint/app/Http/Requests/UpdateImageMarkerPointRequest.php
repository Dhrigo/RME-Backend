<?php

namespace Modules\MedicalRecordImageMarkerPoint\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageMarkerPointRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image_marker_id' => 'sometimes|required|integer',
            'x_coordinate' => 'sometimes|required|numeric',
            'y_coordinate' => 'sometimes|required|numeric',
            'label' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ];
    }
}
