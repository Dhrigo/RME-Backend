<?php

namespace Modules\PendaftaranPatientGuardianContact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranPatientGuardianContact\Http\Requests\StorePatientGuardianContactRequest;
use Modules\PendaftaranPatientGuardianContact\Http\Requests\UpdatePatientGuardianContactRequest;
use Modules\PendaftaranPatientGuardianContact\Http\Resources\PatientGuardianContactResource;
use Modules\PendaftaranPatientGuardianContact\Models\PatientGuardianContact;

class PatientGuardianContactController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientGuardianContact::query();

        if ($request->filled('patient_guardian_id')) {
            $query->where('patient_guardian_id', $request->integer('patient_guardian_id'));
        }

        return PatientGuardianContactResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientGuardianContactRequest $request)
    {
        $contact = PatientGuardianContact::create($request->validated());

        return (new PatientGuardianContactResource($contact))->response()->setStatusCode(201);
    }

    public function show(PatientGuardianContact $patient_guardian_contact): PatientGuardianContactResource
    {
        return new PatientGuardianContactResource($patient_guardian_contact);
    }

    public function update(UpdatePatientGuardianContactRequest $request, PatientGuardianContact $patient_guardian_contact): PatientGuardianContactResource
    {
        $patient_guardian_contact->update($request->validated());

        return new PatientGuardianContactResource($patient_guardian_contact);
    }

    public function destroy(PatientGuardianContact $patient_guardian_contact)
    {
        $patient_guardian_contact->delete();

        return response()->json(null, 204);
    }
}
