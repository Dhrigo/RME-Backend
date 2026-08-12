<?php

namespace Modules\GeneralWardType\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralWardType\Models\WardType;

class WardTypeController extends Controller
{
    public function index()
    {
        return WardType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:ward_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:ward_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(WardType::create($data)->refresh(), 201);
    }

    public function show(WardType $ward_type): WardType
    {
        return $ward_type;
    }

    public function update(Request $request, WardType $ward_type): WardType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('ward_types', 'name')->ignore($ward_type->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('ward_types', 'code')->ignore($ward_type->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $ward_type->update($data);

        return $ward_type;
    }

    public function destroy(WardType $ward_type)
    {
        $ward_type->delete();

        return response()->json(null, 204);
    }
}
