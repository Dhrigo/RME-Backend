<?php

namespace Modules\GeneralAdministration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralAdministration\Models\Administration;

class AdministrationController extends Controller
{
    public function index()
    {
        return Administration::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:administrations,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:administrations,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Administration::create($data)->refresh(), 201);
    }

    public function show(Administration $administration): Administration
    {
        return $administration;
    }

    public function update(Request $request, Administration $administration): Administration
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('administrations', 'name')->ignore($administration->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('administrations', 'code')->ignore($administration->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $administration->update($data);

        return $administration;
    }

    public function destroy(Administration $administration)
    {
        $administration->delete();

        return response()->json(null, 204);
    }
}
