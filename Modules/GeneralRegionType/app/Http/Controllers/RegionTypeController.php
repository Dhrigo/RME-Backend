<?php

namespace Modules\GeneralRegionType\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralRegionType\Models\RegionType;

class RegionTypeController extends Controller
{
    public function index()
    {
        return RegionType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:region_types,name'],
            'digit_count' => ['sometimes', 'integer', 'min:1', 'max:255'],
            'delimiter' => ['sometimes', 'nullable', 'string', 'max:1'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(RegionType::create($data)->refresh(), 201);
    }

    public function show(RegionType $regionType): RegionType
    {
        return $regionType;
    }

    public function update(Request $request, RegionType $regionType): RegionType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('region_types', 'name')->ignore($regionType->id)],
            'digit_count' => ['sometimes', 'integer', 'min:1', 'max:255'],
            'delimiter' => ['sometimes', 'nullable', 'string', 'max:1'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $regionType->update($data);

        return $regionType;
    }

    public function destroy(RegionType $regionType)
    {
        $regionType->delete();

        return response()->json(null, 204);
    }
}
