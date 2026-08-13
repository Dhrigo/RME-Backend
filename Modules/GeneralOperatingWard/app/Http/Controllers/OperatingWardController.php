<?php

namespace Modules\GeneralOperatingWard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralOperatingWard\Models\OperatingWard;

class OperatingWardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => OperatingWard::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string', 'is_active' => 'boolean']);
        $model = OperatingWard::create($validated);
        return response()->json(['data' => $model], 201);
    }

    public function show($id)
    {
        return response()->json(['data' => OperatingWard::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string', 'is_active' => 'boolean']);
        $model = OperatingWard::findOrFail($id);
        $model->update($validated);
        return response()->json(['data' => $model]);
    }

    public function destroy($id)
    {
        $model = OperatingWard::findOrFail($id);
        $model->delete();
        return response()->json(null, 204);
    }
}
