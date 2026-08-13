<?php

namespace Modules\GeneralRadiologyWard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralRadiologyWard\Models\RadiologyWard;

class RadiologyWardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => RadiologyWard::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string', 'is_active' => 'boolean']);
        $model = RadiologyWard::create($validated);
        return response()->json(['data' => $model], 201);
    }

    public function show($id)
    {
        return response()->json(['data' => RadiologyWard::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string', 'is_active' => 'boolean']);
        $model = RadiologyWard::findOrFail($id);
        $model->update($validated);
        return response()->json(['data' => $model]);
    }

    public function destroy($id)
    {
        $model = RadiologyWard::findOrFail($id);
        $model->delete();
        return response()->json(null, 204);
    }
}
