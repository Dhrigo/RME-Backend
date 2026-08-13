<?php

namespace Modules\MedicalRecordAdmissionMedicationReconciliationItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordAdmissionMedicationReconciliationItem\Http\Requests\StoreAdmissionMedicationReconciliationItemRequest;
use Modules\MedicalRecordAdmissionMedicationReconciliationItem\Http\Resources\AdmissionMedicationReconciliationItemResource;
use Modules\MedicalRecordAdmissionMedicationReconciliationItem\Models\AdmissionMedicationReconciliationItem;

class AdmissionMedicationReconciliationItemController extends Controller
{
    public function index(Request $request)
    {
        $query = AdmissionMedicationReconciliationItem::query();

        if ($request->filled('reconciliation_id')) {
            $query->where('reconciliation_id', $request->integer('reconciliation_id'));
        }

        return AdmissionMedicationReconciliationItemResource::collection($query->latest('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAdmissionMedicationReconciliationItemRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $record = AdmissionMedicationReconciliationItem::create($data);

        return (new AdmissionMedicationReconciliationItemResource($record))->response()->setStatusCode(201);
    }

    public function show(AdmissionMedicationReconciliationItem $record): AdmissionMedicationReconciliationItemResource
    {
        return new AdmissionMedicationReconciliationItemResource($record);
    }
}
