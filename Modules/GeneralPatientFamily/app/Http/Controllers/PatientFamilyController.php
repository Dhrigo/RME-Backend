<?php

namespace Modules\GeneralPatientFamily\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPatientFamily\Models\PatientFamily;

class PatientFamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => PatientFamily::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $model = PatientFamily::create($validated);
        return response()->json(['data' => $model], 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return response()->json(['data' => PatientFamily::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'patient_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $model = PatientFamily::findOrFail($id);
        $model->update($validated);
        return response()->json(['data' => $model]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = PatientFamily::findOrFail($id);
        $model->delete();
        return response()->json(null, 204);
    }
}
