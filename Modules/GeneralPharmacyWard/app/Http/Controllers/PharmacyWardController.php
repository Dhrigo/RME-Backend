<?php

namespace Modules\GeneralPharmacyWard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPharmacyWard\Models\PharmacyWard;

class PharmacyWardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => PharmacyWard::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string', 'is_active' => 'boolean']);
        $model = PharmacyWard::create($validated);
        return response()->json(['data' => $model], 201);
    }

    public function show($id)
    {
        return response()->json(['data' => PharmacyWard::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string', 'is_active' => 'boolean']);
        $model = PharmacyWard::findOrFail($id);
        $model->update($validated);
        return response()->json(['data' => $model]);
    }

    public function destroy($id)
    {
        $model = PharmacyWard::findOrFail($id);
        $model->delete();
        return response()->json(null, 204);
    }
}
