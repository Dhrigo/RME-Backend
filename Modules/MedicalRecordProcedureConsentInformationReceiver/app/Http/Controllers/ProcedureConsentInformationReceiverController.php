<?php

namespace Modules\MedicalRecordProcedureConsentInformationReceiver\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordProcedureConsentInformationReceiver\Http\Requests\StoreProcedureConsentInformationReceiverRequest;
use Modules\MedicalRecordProcedureConsentInformationReceiver\Http\Resources\ProcedureConsentInformationReceiverResource;
use Modules\MedicalRecordProcedureConsentInformationReceiver\Models\ProcedureConsentInformationReceiver;

class ProcedureConsentInformationReceiverController extends Controller
{
    public function index(Request $request)
    {
        $query = ProcedureConsentInformationReceiver::query();

        if ($request->filled('consent_id')) {
            $query->where('consent_id', $request->integer('consent_id'));
        }

        return ProcedureConsentInformationReceiverResource::collection($query->latest('signed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreProcedureConsentInformationReceiverRequest $request)
    {
        $data = $request->validated();
        $data['receiver_relationship'] ??= 'self';
        $data['signed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = ProcedureConsentInformationReceiver::create($data);

        return (new ProcedureConsentInformationReceiverResource($record))->response()->setStatusCode(201);
    }

    public function show(ProcedureConsentInformationReceiver $record): ProcedureConsentInformationReceiverResource
    {
        return new ProcedureConsentInformationReceiverResource($record);
    }
}
