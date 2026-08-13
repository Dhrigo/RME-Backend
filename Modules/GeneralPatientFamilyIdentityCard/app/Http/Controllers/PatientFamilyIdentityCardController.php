<?php

namespace Modules\GeneralPatientFamilyIdentityCard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPatientFamilyIdentityCard\Models\PatientFamilyIdentityCard;

class PatientFamilyIdentityCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => PatientFamilyIdentityCard::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_family_id' => 'required|integer',
            'identity_type' => 'required|string|max:255',
            'identity_number' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $model = PatientFamilyIdentityCard::create($validated);
        return response()->json(['data' => $model], 201);
    }

    public function show($id)
    {
        return response()->json(['data' => PatientFamilyIdentityCard::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'patient_family_id' => 'required|integer',
            'identity_type' => 'required|string|max:255',
            'identity_number' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $model = PatientFamilyIdentityCard::findOrFail($id);
        $model->update($validated);
        return response()->json(['data' => $model]);
    }

    public function destroy($id)
    {
        $model = PatientFamilyIdentityCard::findOrFail($id);
        $model->delete();
        return response()->json(null, 204);
    }
}
