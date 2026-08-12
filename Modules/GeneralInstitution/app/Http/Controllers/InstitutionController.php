<?php

namespace Modules\GeneralInstitution\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralInstitution\Models\Institution;

class InstitutionController extends Controller
{
    public function index()
    {
        return Institution::query()->orderBy('id')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ppk_id' => ['nullable', 'integer', 'unique:institutions,ppk_id'],
            'email' => ['required', 'email', 'max:50'],
            'website' => ['required', 'string', 'max:50'],
        ]);

        return response()->json(Institution::create($data)->refresh(), 201);
    }

    public function show(Institution $institution): Institution
    {
        return $institution;
    }

    public function update(Request $request, Institution $institution): Institution
    {
        $data = $request->validate([
            'ppk_id' => ['nullable', 'integer', Rule::unique('institutions', 'ppk_id')->ignore($institution->id)],
            'email' => ['sometimes', 'email', 'max:50'],
            'website' => ['sometimes', 'string', 'max:50'],
        ]);

        $institution->update($data);

        return $institution;
    }

    public function destroy(Institution $institution)
    {
        $institution->delete();

        return response()->json(null, 204);
    }
}
