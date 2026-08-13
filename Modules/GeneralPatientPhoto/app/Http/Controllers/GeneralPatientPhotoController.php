<?php

namespace Modules\GeneralPatientPhoto\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPatientPhoto\Models\PatientPhoto;

class GeneralPatientPhotoController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientPhoto::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return $query->orderBy('id')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'file_path' => ['required', 'string', 'max:255'],
            'taken_at' => ['required', 'date'],
        ]);

        return response()->json(PatientPhoto::create($data)->refresh(), 201);
    }

    public function show(PatientPhoto $patientPhoto): PatientPhoto
    {
        return $patientPhoto;
    }

    public function update(Request $request, PatientPhoto $patientPhoto): PatientPhoto
    {
        $data = $request->validate([
            'file_path' => ['sometimes', 'string', 'max:255'],
            'taken_at' => ['sometimes', 'date'],
        ]);

        $patientPhoto->update($data);

        return $patientPhoto;
    }

    public function destroy(PatientPhoto $patientPhoto)
    {
        $patientPhoto->delete();

        return response()->json(null, 204);
    }
}
