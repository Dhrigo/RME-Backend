<?php

namespace Modules\GeneralLabServiceGroup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralLabServiceGroup\Models\LabServiceGroup;

class LabServiceGroupController extends Controller
{
    public function index()
    {
        return LabServiceGroup::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:lab_service_groups,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:lab_service_groups,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(LabServiceGroup::create($data)->refresh(), 201);
    }

    public function show(LabServiceGroup $lab_service_group): LabServiceGroup
    {
        return $lab_service_group;
    }

    public function update(Request $request, LabServiceGroup $lab_service_group): LabServiceGroup
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('lab_service_groups', 'name')->ignore($lab_service_group->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('lab_service_groups', 'code')->ignore($lab_service_group->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $lab_service_group->update($data);

        return $lab_service_group;
    }

    public function destroy(LabServiceGroup $lab_service_group)
    {
        $lab_service_group->delete();

        return response()->json(null, 204);
    }
}
