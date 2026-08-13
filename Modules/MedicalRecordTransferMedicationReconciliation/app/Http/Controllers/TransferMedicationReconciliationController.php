<?php

namespace Modules\MedicalRecordTransferMedicationReconciliation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordTransferMedicationReconciliation\Http\Requests\StoreTransferMedicationReconciliationRequest;
use Modules\MedicalRecordTransferMedicationReconciliation\Http\Resources\TransferMedicationReconciliationResource;
use Modules\MedicalRecordTransferMedicationReconciliation\Models\TransferMedicationReconciliation;

class TransferMedicationReconciliationController extends Controller
{
    public function index(Request $request)
    {
        $query = TransferMedicationReconciliation::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return TransferMedicationReconciliationResource::collection($query->latest('reconciled_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreTransferMedicationReconciliationRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'draft';
        $data['reconciled_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = TransferMedicationReconciliation::create($data);

        return (new TransferMedicationReconciliationResource($record))->response()->setStatusCode(201);
    }

    public function show(TransferMedicationReconciliation $record): TransferMedicationReconciliationResource
    {
        return new TransferMedicationReconciliationResource($record);
    }
}
