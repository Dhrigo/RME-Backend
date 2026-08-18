<?php

namespace Modules\GeneralPatientFamilyContact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPatientFamilyContact\Http\Requests\StorePatientFamilyContactRequest;
use Modules\GeneralPatientFamilyContact\Http\Requests\UpdatePatientFamilyContactRequest;
use Modules\GeneralPatientFamilyContact\Http\Resources\PatientFamilyContactResource;
use Modules\GeneralPatientFamilyContact\Models\PatientFamilyContact;

class PatientFamilyContactController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientFamilyContact::query();

        if ($request->filled('patient_family_id')) {
            $query->where('patient_family_id', $request->integer('patient_family_id'));
        }

        return PatientFamilyContactResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientFamilyContactRequest $request)
    {
        $contact = PatientFamilyContact::create($request->validated());

        return (new PatientFamilyContactResource($contact))->response()->setStatusCode(201);
    }

    public function show(PatientFamilyContact $patient_family_contact): PatientFamilyContactResource
    {
        return new PatientFamilyContactResource($patient_family_contact);
    }

    public function update(UpdatePatientFamilyContactRequest $request, PatientFamilyContact $patient_family_contact): PatientFamilyContactResource
    {
        $patient_family_contact->update($request->validated());

        return new PatientFamilyContactResource($patient_family_contact->fresh());
    }

    public function destroy(PatientFamilyContact $patient_family_contact)
    {
        $patient_family_contact->delete();

        return response()->json(null, 204);
    }
}
