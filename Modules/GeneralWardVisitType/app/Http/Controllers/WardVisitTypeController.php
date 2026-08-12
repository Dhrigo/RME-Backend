<?php

namespace Modules\GeneralWardVisitType\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralWardVisitType\Models\WardVisitType;

class WardVisitTypeController extends Controller
{
    public function index()
    {
        return WardVisitType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:ward_visit_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:ward_visit_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(WardVisitType::create($data)->refresh(), 201);
    }

    public function show(WardVisitType $ward_visit_type): WardVisitType
    {
        return $ward_visit_type;
    }

    public function update(Request $request, WardVisitType $ward_visit_type): WardVisitType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('ward_visit_types', 'name')->ignore($ward_visit_type->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('ward_visit_types', 'code')->ignore($ward_visit_type->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $ward_visit_type->update($data);

        return $ward_visit_type;
    }

    public function destroy(WardVisitType $ward_visit_type)
    {
        $ward_visit_type->delete();

        return response()->json(null, 204);
    }
}
