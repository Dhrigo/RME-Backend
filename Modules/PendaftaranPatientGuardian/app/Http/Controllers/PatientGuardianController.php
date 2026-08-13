<?php

namespace Modules\PendaftaranPatientGuardian\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranPatientGuardian\Http\Requests\StorePatientGuardianRequest;
use Modules\PendaftaranPatientGuardian\Http\Requests\UpdatePatientGuardianRequest;
use Modules\PendaftaranPatientGuardian\Http\Resources\PatientGuardianResource;
use Modules\PendaftaranPatientGuardian\Models\PatientGuardian;

class PatientGuardianController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientGuardian::query();

        if ($request->filled('registration_id')) {
            $query->where('registration_id', $request->integer('registration_id'));
        }

        return PatientGuardianResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientGuardianRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $guardian = PatientGuardian::create($data);

        return (new PatientGuardianResource($guardian))->response()->setStatusCode(201);
    }

    public function show(PatientGuardian $patient_guardian): PatientGuardianResource
    {
        return new PatientGuardianResource($patient_guardian);
    }

    public function update(UpdatePatientGuardianRequest $request, PatientGuardian $patient_guardian): PatientGuardianResource
    {
        $patient_guardian->update($request->validated());

        return new PatientGuardianResource($patient_guardian);
    }

    public function destroy(PatientGuardian $patient_guardian)
    {
        $patient_guardian->delete();

        return response()->json(null, 204);
    }
}
