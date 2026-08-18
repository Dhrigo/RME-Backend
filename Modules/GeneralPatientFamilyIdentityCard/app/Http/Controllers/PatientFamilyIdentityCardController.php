<?php

namespace Modules\GeneralPatientFamilyIdentityCard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPatientFamilyIdentityCard\Http\Requests\StorePatientFamilyIdentityCardRequest;
use Modules\GeneralPatientFamilyIdentityCard\Http\Requests\UpdatePatientFamilyIdentityCardRequest;
use Modules\GeneralPatientFamilyIdentityCard\Http\Resources\PatientFamilyIdentityCardResource;
use Modules\GeneralPatientFamilyIdentityCard\Models\PatientFamilyIdentityCard;

class PatientFamilyIdentityCardController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientFamilyIdentityCard::query();

        if ($request->filled('patient_family_id')) {
            $query->where('patient_family_id', $request->integer('patient_family_id'));
        }

        return PatientFamilyIdentityCardResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientFamilyIdentityCardRequest $request)
    {
        $card = PatientFamilyIdentityCard::create($request->validated());

        return (new PatientFamilyIdentityCardResource($card))->response()->setStatusCode(201);
    }

    public function show(PatientFamilyIdentityCard $patient_family_identity_card): PatientFamilyIdentityCardResource
    {
        return new PatientFamilyIdentityCardResource($patient_family_identity_card);
    }

    public function update(UpdatePatientFamilyIdentityCardRequest $request, PatientFamilyIdentityCard $patient_family_identity_card): PatientFamilyIdentityCardResource
    {
        $patient_family_identity_card->update($request->validated());

        return new PatientFamilyIdentityCardResource($patient_family_identity_card->fresh());
    }

    public function destroy(PatientFamilyIdentityCard $patient_family_identity_card)
    {
        $patient_family_identity_card->delete();

        return response()->json(null, 204);
    }
}
