<?php

namespace Modules\MedicalRecordProcedureConsentInformationGiver\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordProcedureConsentInformationGiver\Http\Requests\StoreProcedureConsentInformationGiverRequest;
use Modules\MedicalRecordProcedureConsentInformationGiver\Http\Resources\ProcedureConsentInformationGiverResource;
use Modules\MedicalRecordProcedureConsentInformationGiver\Models\ProcedureConsentInformationGiver;

class ProcedureConsentInformationGiverController extends Controller
{
    public function index(Request $request)
    {
        $query = ProcedureConsentInformationGiver::query();

        if ($request->filled('consent_id')) {
            $query->where('consent_id', $request->integer('consent_id'));
        }

        return ProcedureConsentInformationGiverResource::collection($query->latest('signed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreProcedureConsentInformationGiverRequest $request)
    {
        $data = $request->validated();
        $data['giver_role'] ??= 'doctor';
        $data['signed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = ProcedureConsentInformationGiver::create($data);

        return (new ProcedureConsentInformationGiverResource($record))->response()->setStatusCode(201);
    }

    public function show(ProcedureConsentInformationGiver $record): ProcedureConsentInformationGiverResource
    {
        return new ProcedureConsentInformationGiverResource($record);
    }
}
