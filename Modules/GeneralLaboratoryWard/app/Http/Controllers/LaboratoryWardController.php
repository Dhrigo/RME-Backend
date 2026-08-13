<?php

namespace Modules\GeneralLaboratoryWard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralLaboratoryWard\Models\LaboratoryWard;

class LaboratoryWardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => LaboratoryWard::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string', 'is_active' => 'boolean']);
        $model = LaboratoryWard::create($validated);
        return response()->json(['data' => $model], 201);
    }

    public function show($id)
    {
        return response()->json(['data' => LaboratoryWard::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string', 'is_active' => 'boolean']);
        $model = LaboratoryWard::findOrFail($id);
        $model->update($validated);
        return response()->json(['data' => $model]);
    }

    public function destroy($id)
    {
        $model = LaboratoryWard::findOrFail($id);
        $model->delete();
        return response()->json(null, 204);
    }
}
