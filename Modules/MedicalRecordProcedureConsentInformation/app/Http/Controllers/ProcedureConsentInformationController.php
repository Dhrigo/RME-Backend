<?php

namespace Modules\MedicalRecordProcedureConsentInformation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordProcedureConsentInformation\Http\Requests\StoreProcedureConsentInformationRequest;
use Modules\MedicalRecordProcedureConsentInformation\Http\Resources\ProcedureConsentInformationResource;
use Modules\MedicalRecordProcedureConsentInformation\Models\ProcedureConsentInformation;

class ProcedureConsentInformationController extends Controller
{
    public function index(Request $request)
    {
        $query = ProcedureConsentInformation::query();

        if ($request->filled('consent_id')) {
            $query->where('consent_id', $request->integer('consent_id'));
        }

        return ProcedureConsentInformationResource::collection($query->latest('explained_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreProcedureConsentInformationRequest $request)
    {
        $data = $request->validated();
        $data['explained_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = ProcedureConsentInformation::create($data);

        return (new ProcedureConsentInformationResource($record))->response()->setStatusCode(201);
    }

    public function show(ProcedureConsentInformation $record): ProcedureConsentInformationResource
    {
        return new ProcedureConsentInformationResource($record);
    }
}
