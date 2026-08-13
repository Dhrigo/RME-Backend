<?php

namespace Modules\PendaftaranPatientEscort\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranPatientEscort\Http\Requests\StorePatientEscortRequest;
use Modules\PendaftaranPatientEscort\Http\Requests\UpdatePatientEscortRequest;
use Modules\PendaftaranPatientEscort\Http\Resources\PatientEscortResource;
use Modules\PendaftaranPatientEscort\Models\PatientEscort;

class PatientEscortController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientEscort::query();

        if ($request->filled('registration_id')) {
            $query->where('registration_id', $request->integer('registration_id'));
        }

        return PatientEscortResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientEscortRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $escort = PatientEscort::create($data);

        return (new PatientEscortResource($escort))->response()->setStatusCode(201);
    }

    public function show(PatientEscort $patient_escort): PatientEscortResource
    {
        return new PatientEscortResource($patient_escort);
    }

    public function update(UpdatePatientEscortRequest $request, PatientEscort $patient_escort): PatientEscortResource
    {
        $patient_escort->update($request->validated());

        return new PatientEscortResource($patient_escort);
    }

    public function destroy(PatientEscort $patient_escort)
    {
        $patient_escort->delete();

        return response()->json(null, 204);
    }
}
