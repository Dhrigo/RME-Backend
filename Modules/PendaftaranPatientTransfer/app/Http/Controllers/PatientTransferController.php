<?php

namespace Modules\PendaftaranPatientTransfer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranPatientTransfer\Http\Requests\StorePatientTransferRequest;
use Modules\PendaftaranPatientTransfer\Http\Resources\PatientTransferResource;
use Modules\PendaftaranPatientTransfer\Models\PatientTransfer;

class PatientTransferController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientTransfer::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PatientTransferResource::collection($query->latest('transferred_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientTransferRequest $request)
    {
        $data = $request->validated();
        $data['transferred_at'] ??= now();

        $transfer = PatientTransfer::create($data);

        return (new PatientTransferResource($transfer))->response()->setStatusCode(201);
    }

    public function show(PatientTransfer $patienttransfer): PatientTransferResource
    {
        return new PatientTransferResource($patienttransfer);
    }
}
