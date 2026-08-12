<?php

namespace Modules\GeneralReligion\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralReligion\Models\Religion;

class ReligionController extends Controller
{
    public function index()
    {
        return Religion::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:religions,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:religions,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Religion::create($data)->refresh(), 201);
    }

    public function show(Religion $religion): Religion
    {
        return $religion;
    }

    public function update(Request $request, Religion $religion): Religion
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('religions', 'name')->ignore($religion->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('religions', 'code')->ignore($religion->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $religion->update($data);

        return $religion;
    }

    public function destroy(Religion $religion)
    {
        $religion->delete();

        return response()->json(null, 204);
    }
}
