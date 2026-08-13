<?php

namespace Modules\PembayaranPatientReceivableSettlement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\PembayaranPatientReceivable\Models\PatientReceivable;
use Modules\PembayaranPatientReceivableSettlement\Http\Requests\StorePatientReceivableSettlementRequest;
use Modules\PembayaranPatientReceivableSettlement\Http\Resources\PatientReceivableSettlementResource;
use Modules\PembayaranPatientReceivableSettlement\Models\PatientReceivableSettlement;

class PatientReceivableSettlementController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientReceivableSettlement::query();

        if ($request->filled('patient_receivable_id')) {
            $query->where('patient_receivable_id', $request->integer('patient_receivable_id'));
        }

        return PatientReceivableSettlementResource::collection($query->latest('paid_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Settlement is a financial record - append-only, no update/delete.
     * Marks the parent receivable as settled.
     */
    public function store(StorePatientReceivableSettlementRequest $request)
    {
        $data = $request->validated();
        $data['paid_at'] ??= now();
        $data['received_by'] = $request->user()->id;

        $settlement = DB::transaction(function () use ($data) {
            $settlement = PatientReceivableSettlement::create($data);
            PatientReceivable::whereKey($data['patient_receivable_id'])->update(['status' => 'settled']);

            return $settlement;
        });

        return (new PatientReceivableSettlementResource($settlement))->response()->setStatusCode(201);
    }

    public function show(PatientReceivableSettlement $patient_receivable_settlement): PatientReceivableSettlementResource
    {
        return new PatientReceivableSettlementResource($patient_receivable_settlement);
    }
}
