<?php

namespace Modules\GeneralLabServiceParameter\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralLabServiceParameter\Models\LabServiceParameter;

class LabServiceParameterController extends Controller
{
    public function index()
    {
        return LabServiceParameter::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'lab_service_group_id' => ['nullable', 'integer', 'exists:lab_service_groups,id'],
            'name' => ['required', 'string', 'max:255', 'unique:lab_service_parameters,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:lab_service_parameters,code'],
            'unit' => ['nullable', 'string', 'max:20'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(LabServiceParameter::create($data)->refresh(), 201);
    }

    public function show(LabServiceParameter $lab_service_parameter): LabServiceParameter
    {
        return $lab_service_parameter;
    }

    public function update(Request $request, LabServiceParameter $lab_service_parameter): LabServiceParameter
    {
        $data = $request->validate([
            'lab_service_group_id' => ['nullable', 'integer', 'exists:lab_service_groups,id'],
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('lab_service_parameters', 'name')->ignore($lab_service_parameter->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('lab_service_parameters', 'code')->ignore($lab_service_parameter->id)],
            'unit' => ['nullable', 'string', 'max:20'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $lab_service_parameter->update($data);

        return $lab_service_parameter;
    }

    public function destroy(LabServiceParameter $lab_service_parameter)
    {
        $lab_service_parameter->delete();

        return response()->json(null, 204);
    }
}
