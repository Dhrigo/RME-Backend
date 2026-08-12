<?php

namespace Modules\GeneralLabReferenceValue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralLabReferenceValue\Models\LabReferenceValue;

class LabReferenceValueController extends Controller
{
    public function index()
    {
        return LabReferenceValue::query()->orderBy('lab_service_parameter_id')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'lab_service_parameter_id' => ['required', 'integer', 'exists:lab_service_parameters,id'],
            'gender' => ['sometimes', 'in:male,female,all'],
            'min_age' => ['nullable', 'integer', 'min:0'],
            'max_age' => ['nullable', 'integer', 'min:0', 'gte:min_age'],
            'min_value' => ['nullable', 'numeric'],
            'max_value' => ['nullable', 'numeric', 'gte:min_value'],
            'unit' => ['nullable', 'string', 'max:20'],
            'note' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(LabReferenceValue::create($data)->refresh(), 201);
    }

    public function show(LabReferenceValue $lab_reference_value): LabReferenceValue
    {
        return $lab_reference_value;
    }

    public function update(Request $request, LabReferenceValue $lab_reference_value): LabReferenceValue
    {
        $data = $request->validate([
            'lab_service_parameter_id' => ['sometimes', 'integer', 'exists:lab_service_parameters,id'],
            'gender' => ['sometimes', 'in:male,female,all'],
            'min_age' => ['nullable', 'integer', 'min:0'],
            'max_age' => ['nullable', 'integer', 'min:0', 'gte:min_age'],
            'min_value' => ['nullable', 'numeric'],
            'max_value' => ['nullable', 'numeric', 'gte:min_value'],
            'unit' => ['nullable', 'string', 'max:20'],
            'note' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $lab_reference_value->update($data);

        return $lab_reference_value;
    }

    public function destroy(LabReferenceValue $lab_reference_value)
    {
        $lab_reference_value->delete();

        return response()->json(null, 204);
    }
}
