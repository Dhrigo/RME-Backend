<?php

namespace Modules\GeneralExaminationGroup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralExaminationGroup\Models\ExaminationGroup;

class ExaminationGroupController extends Controller
{
    public function index()
    {
        return ExaminationGroup::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:examination_groups,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:examination_groups,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ExaminationGroup::create($data)->refresh(), 201);
    }

    public function show(ExaminationGroup $examination_group): ExaminationGroup
    {
        return $examination_group;
    }

    public function update(Request $request, ExaminationGroup $examination_group): ExaminationGroup
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('examination_groups', 'name')->ignore($examination_group->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('examination_groups', 'code')->ignore($examination_group->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $examination_group->update($data);

        return $examination_group;
    }

    public function destroy(ExaminationGroup $examination_group)
    {
        $examination_group->delete();

        return response()->json(null, 204);
    }
}
