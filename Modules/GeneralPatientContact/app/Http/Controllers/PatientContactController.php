<?php

namespace Modules\GeneralPatientContact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\GeneralPatientContact\Http\Requests\StorePatientContactRequest;
use Modules\GeneralPatientContact\Http\Requests\UpdatePatientContactRequest;
use Modules\GeneralPatientContact\Http\Resources\PatientContactResource;
use Modules\GeneralPatientContact\Models\PatientContact;

class PatientContactController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientContact::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return PatientContactResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    /**
     * Only one primary contact per patient - setting is_primary=true here demotes
     * any previous primary contact for the same patient.
     */
    public function store(StorePatientContactRequest $request)
    {
        $data = $request->validated();

        $contact = DB::transaction(function () use ($data) {
            if ($data['is_primary'] ?? false) {
                PatientContact::query()->where('patient_id', $data['patient_id'])->update(['is_primary' => false]);
            }

            return PatientContact::create($data);
        });

        return (new PatientContactResource($contact))->response()->setStatusCode(201);
    }

    public function show(PatientContact $patient_contact): PatientContactResource
    {
        return new PatientContactResource($patient_contact);
    }

    public function update(UpdatePatientContactRequest $request, PatientContact $patient_contact): PatientContactResource
    {
        $data = $request->validated();

        DB::transaction(function () use ($data, $patient_contact) {
            if ($data['is_primary'] ?? false) {
                PatientContact::query()
                    ->where('patient_id', $patient_contact->patient_id)
                    ->where('id', '!=', $patient_contact->id)
                    ->update(['is_primary' => false]);
            }

            $patient_contact->update($data);
        });

        return new PatientContactResource($patient_contact->fresh());
    }

    public function destroy(PatientContact $patient_contact)
    {
        $patient_contact->delete();

        return response()->json(null, 204);
    }
}
