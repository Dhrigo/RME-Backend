<?php

namespace Modules\GeneralPatientFamilyContact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPatientFamilyContact\Models\PatientFamilyContact;

class PatientFamilyContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => PatientFamilyContact::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_family_id' => 'required|integer',
            'contact_type' => 'required|string|max:255',
            'contact_value' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $model = PatientFamilyContact::create($validated);
        return response()->json(['data' => $model], 201);
    }

    public function show($id)
    {
        return response()->json(['data' => PatientFamilyContact::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'patient_family_id' => 'required|integer',
            'contact_type' => 'required|string|max:255',
            'contact_value' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $model = PatientFamilyContact::findOrFail($id);
        $model->update($validated);
        return response()->json(['data' => $model]);
    }

    public function destroy($id)
    {
        $model = PatientFamilyContact::findOrFail($id);
        $model->delete();
        return response()->json(null, 204);
    }
}
