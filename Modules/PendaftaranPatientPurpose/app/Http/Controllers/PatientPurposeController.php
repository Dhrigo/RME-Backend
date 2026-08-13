<?php

namespace Modules\PendaftaranPatientPurpose\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\PendaftaranPatientPurpose\Models\PatientPurpose;

class PatientPurposeController extends Controller
{
    public function index()
    {
        return PatientPurpose::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:patient_purposes,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:patient_purposes,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PatientPurpose::create($data)->refresh(), 201);
    }

    public function show(PatientPurpose $patientPurpose): PatientPurpose
    {
        return $patientPurpose;
    }

    public function update(Request $request, PatientPurpose $patientPurpose): PatientPurpose
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('patient_purposes', 'name')->ignore($patientPurpose->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('patient_purposes', 'code')->ignore($patientPurpose->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $patientPurpose->update($data);

        return $patientPurpose;
    }

    public function destroy(PatientPurpose $patientPurpose)
    {
        $patientPurpose->delete();

        return response()->json(null, 204);
    }
}