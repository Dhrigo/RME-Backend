<?php

namespace Modules\PendaftaranPatientEscortContact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranPatientEscortContact\Http\Requests\StorePatientEscortContactRequest;
use Modules\PendaftaranPatientEscortContact\Http\Requests\UpdatePatientEscortContactRequest;
use Modules\PendaftaranPatientEscortContact\Http\Resources\PatientEscortContactResource;
use Modules\PendaftaranPatientEscortContact\Models\PatientEscortContact;

class PatientEscortContactController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientEscortContact::query();

        if ($request->filled('patient_escort_id')) {
            $query->where('patient_escort_id', $request->integer('patient_escort_id'));
        }

        return PatientEscortContactResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientEscortContactRequest $request)
    {
        $contact = PatientEscortContact::create($request->validated());

        return (new PatientEscortContactResource($contact))->response()->setStatusCode(201);
    }

    public function show(PatientEscortContact $patient_escort_contact): PatientEscortContactResource
    {
        return new PatientEscortContactResource($patient_escort_contact);
    }

    public function update(UpdatePatientEscortContactRequest $request, PatientEscortContact $patient_escort_contact): PatientEscortContactResource
    {
        $patient_escort_contact->update($request->validated());

        return new PatientEscortContactResource($patient_escort_contact);
    }

    public function destroy(PatientEscortContact $patient_escort_contact)
    {
        $patient_escort_contact->delete();

        return response()->json(null, 204);
    }
}
