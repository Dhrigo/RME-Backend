<?php

namespace Modules\MedicalRecordTransferMedicationReconciliationItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordTransferMedicationReconciliationItem\Http\Requests\StoreTransferMedicationReconciliationItemRequest;
use Modules\MedicalRecordTransferMedicationReconciliationItem\Http\Resources\TransferMedicationReconciliationItemResource;
use Modules\MedicalRecordTransferMedicationReconciliationItem\Models\TransferMedicationReconciliationItem;

class TransferMedicationReconciliationItemController extends Controller
{
    public function index(Request $request)
    {
        $query = TransferMedicationReconciliationItem::query();

        if ($request->filled('reconciliation_id')) {
            $query->where('reconciliation_id', $request->integer('reconciliation_id'));
        }

        return TransferMedicationReconciliationItemResource::collection($query->latest('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreTransferMedicationReconciliationItemRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $record = TransferMedicationReconciliationItem::create($data);

        return (new TransferMedicationReconciliationItemResource($record))->response()->setStatusCode(201);
    }

    public function show(TransferMedicationReconciliationItem $record): TransferMedicationReconciliationItemResource
    {
        return new TransferMedicationReconciliationItemResource($record);
    }
}
