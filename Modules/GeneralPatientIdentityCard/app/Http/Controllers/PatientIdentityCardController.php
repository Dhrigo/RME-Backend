<?php

namespace Modules\GeneralPatientIdentityCard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPatientIdentityCard\Http\Requests\StorePatientIdentityCardRequest;
use Modules\GeneralPatientIdentityCard\Http\Requests\UpdatePatientIdentityCardRequest;
use Modules\GeneralPatientIdentityCard\Http\Resources\PatientIdentityCardResource;
use Modules\GeneralPatientIdentityCard\Models\PatientIdentityCard;

class PatientIdentityCardController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientIdentityCard::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return PatientIdentityCardResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientIdentityCardRequest $request)
    {
        $card = PatientIdentityCard::create($request->validated());

        return (new PatientIdentityCardResource($card))->response()->setStatusCode(201);
    }

    public function show(PatientIdentityCard $patientIdentityCard): PatientIdentityCardResource
    {
        return new PatientIdentityCardResource($patientIdentityCard);
    }

    public function update(UpdatePatientIdentityCardRequest $request, PatientIdentityCard $patientIdentityCard): PatientIdentityCardResource
    {
        $patientIdentityCard->update($request->validated());

        return new PatientIdentityCardResource($patientIdentityCard);
    }

    public function destroy(PatientIdentityCard $patientIdentityCard)
    {
        $patientIdentityCard->delete();

        return response()->noContent();
    }
}
