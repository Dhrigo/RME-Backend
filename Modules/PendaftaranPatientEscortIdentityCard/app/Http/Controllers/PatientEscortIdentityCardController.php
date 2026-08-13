<?php

namespace Modules\PendaftaranPatientEscortIdentityCard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranPatientEscortIdentityCard\Http\Requests\StorePatientEscortIdentityCardRequest;
use Modules\PendaftaranPatientEscortIdentityCard\Http\Requests\UpdatePatientEscortIdentityCardRequest;
use Modules\PendaftaranPatientEscortIdentityCard\Http\Resources\PatientEscortIdentityCardResource;
use Modules\PendaftaranPatientEscortIdentityCard\Models\PatientEscortIdentityCard;

class PatientEscortIdentityCardController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientEscortIdentityCard::query();

        if ($request->filled('patient_escort_id')) {
            $query->where('patient_escort_id', $request->integer('patient_escort_id'));
        }

        return PatientEscortIdentityCardResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientEscortIdentityCardRequest $request)
    {
        $card = PatientEscortIdentityCard::create($request->validated());

        return (new PatientEscortIdentityCardResource($card))->response()->setStatusCode(201);
    }

    public function show(PatientEscortIdentityCard $patient_escort_identity_card): PatientEscortIdentityCardResource
    {
        return new PatientEscortIdentityCardResource($patient_escort_identity_card);
    }

    public function update(UpdatePatientEscortIdentityCardRequest $request, PatientEscortIdentityCard $patient_escort_identity_card): PatientEscortIdentityCardResource
    {
        $patient_escort_identity_card->update($request->validated());

        return new PatientEscortIdentityCardResource($patient_escort_identity_card);
    }

    public function destroy(PatientEscortIdentityCard $patient_escort_identity_card)
    {
        $patient_escort_identity_card->delete();

        return response()->json(null, 204);
    }
}
