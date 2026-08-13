<?php

namespace Modules\PendaftaranPatientGuardianIdentityCard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranPatientGuardianIdentityCard\Http\Requests\StorePatientGuardianIdentityCardRequest;
use Modules\PendaftaranPatientGuardianIdentityCard\Http\Requests\UpdatePatientGuardianIdentityCardRequest;
use Modules\PendaftaranPatientGuardianIdentityCard\Http\Resources\PatientGuardianIdentityCardResource;
use Modules\PendaftaranPatientGuardianIdentityCard\Models\PatientGuardianIdentityCard;

class PatientGuardianIdentityCardController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientGuardianIdentityCard::query();

        if ($request->filled('patient_guardian_id')) {
            $query->where('patient_guardian_id', $request->integer('patient_guardian_id'));
        }

        return PatientGuardianIdentityCardResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientGuardianIdentityCardRequest $request)
    {
        $card = PatientGuardianIdentityCard::create($request->validated());

        return (new PatientGuardianIdentityCardResource($card))->response()->setStatusCode(201);
    }

    public function show(PatientGuardianIdentityCard $patient_guardian_identity_card): PatientGuardianIdentityCardResource
    {
        return new PatientGuardianIdentityCardResource($patient_guardian_identity_card);
    }

    public function update(UpdatePatientGuardianIdentityCardRequest $request, PatientGuardianIdentityCard $patient_guardian_identity_card): PatientGuardianIdentityCardResource
    {
        $patient_guardian_identity_card->update($request->validated());

        return new PatientGuardianIdentityCardResource($patient_guardian_identity_card);
    }

    public function destroy(PatientGuardianIdentityCard $patient_guardian_identity_card)
    {
        $patient_guardian_identity_card->delete();

        return response()->json(null, 204);
    }
}
