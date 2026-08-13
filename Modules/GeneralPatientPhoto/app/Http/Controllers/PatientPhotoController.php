<?php

namespace Modules\GeneralPatientPhoto\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPatientPhoto\Models\PatientPhoto;

class PatientPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => PatientPhoto::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string', 'is_active' => 'boolean']);
        $model = PatientPhoto::create($validated);
        return response()->json(['data' => $model], 201);
    }

    public function show($id)
    {
        return response()->json(['data' => PatientPhoto::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string', 'is_active' => 'boolean']);
        $model = PatientPhoto::findOrFail($id);
        $model->update($validated);
        return response()->json(['data' => $model]);
    }

    public function destroy($id)
    {
        $model = PatientPhoto::findOrFail($id);
        $model->delete();
        return response()->json(null, 204);
    }
}
