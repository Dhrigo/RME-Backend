<?php

namespace Modules\GeneralPatient\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPatient\Http\Requests\StorePatientRequest;
use Modules\GeneralPatient\Http\Requests\UpdatePatientRequest;
use Modules\GeneralPatient\Http\Resources\PatientResource;
use Modules\GeneralPatient\Models\Patient;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->string('name').'%');
        }

        if ($request->filled('medical_record_number')) {
            $query->where('medical_record_number', $request->string('medical_record_number'));
        }

        return PatientResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientRequest $request)
    {
        $data = $request->validated();
        $data['medical_record_number'] ??= Patient::generateMedicalRecordNumber();
        $data['registered_by'] = $request->user()->id;

        $patient = Patient::create($data);

        return (new PatientResource($patient))->response()->setStatusCode(201);
    }

    public function show(Patient $patient): PatientResource
    {
        return new PatientResource($patient);
    }

    public function update(UpdatePatientRequest $request, Patient $patient): PatientResource
    {
        $patient->update($request->validated());

        return new PatientResource($patient);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->json(null, 204);
    }
}
