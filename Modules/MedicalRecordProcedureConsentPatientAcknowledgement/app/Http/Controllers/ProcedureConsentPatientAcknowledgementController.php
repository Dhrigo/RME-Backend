<?php

namespace Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Http\Requests\StoreProcedureConsentPatientAcknowledgementRequest;
use Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Http\Resources\ProcedureConsentPatientAcknowledgementResource;
use Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Models\ProcedureConsentPatientAcknowledgement;

class ProcedureConsentPatientAcknowledgementController extends Controller
{
    public function index(Request $request)
    {
        $query = ProcedureConsentPatientAcknowledgement::query();

        if ($request->filled('consent_id')) {
            $query->where('consent_id', $request->integer('consent_id'));
        }

        return ProcedureConsentPatientAcknowledgementResource::collection($query->latest('signed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreProcedureConsentPatientAcknowledgementRequest $request)
    {
        $data = $request->validated();
        $data['relationship_to_patient'] ??= 'self';
        $data['signed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = ProcedureConsentPatientAcknowledgement::create($data);

        return (new ProcedureConsentPatientAcknowledgementResource($record))->response()->setStatusCode(201);
    }

    public function show(ProcedureConsentPatientAcknowledgement $record): ProcedureConsentPatientAcknowledgementResource
    {
        return new ProcedureConsentPatientAcknowledgementResource($record);
    }
}
