<?php

namespace Modules\GeneralLabGroup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralLabGroup\Models\LabGroup;

class LabGroupController extends Controller
{
    public function index()
    {
        return LabGroup::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:lab_groups,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:lab_groups,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(LabGroup::create($data)->refresh(), 201);
    }

    public function show(LabGroup $lab_group): LabGroup
    {
        return $lab_group;
    }

    public function update(Request $request, LabGroup $lab_group): LabGroup
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('lab_groups', 'name')->ignore($lab_group->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('lab_groups', 'code')->ignore($lab_group->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $lab_group->update($data);

        return $lab_group;
    }

    public function destroy(LabGroup $lab_group)
    {
        $lab_group->delete();

        return response()->json(null, 204);
    }
}
