<?php

namespace Modules\MedicalRecordDischargeMedicationReconciliationItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordDischargeMedicationReconciliationItem\Http\Requests\StoreDischargeMedicationReconciliationItemRequest;
use Modules\MedicalRecordDischargeMedicationReconciliationItem\Http\Resources\DischargeMedicationReconciliationItemResource;
use Modules\MedicalRecordDischargeMedicationReconciliationItem\Models\DischargeMedicationReconciliationItem;

class DischargeMedicationReconciliationItemController extends Controller
{
    public function index(Request $request)
    {
        $query = DischargeMedicationReconciliationItem::query();

        if ($request->filled('reconciliation_id')) {
            $query->where('reconciliation_id', $request->integer('reconciliation_id'));
        }

        return DischargeMedicationReconciliationItemResource::collection($query->latest('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreDischargeMedicationReconciliationItemRequest $request)
    {
        $data = $request->validated();
        $data['patient_education_given'] ??= false;
        $data['created_by'] = $request->user()->id;

        $record = DischargeMedicationReconciliationItem::create($data);

        return (new DischargeMedicationReconciliationItemResource($record))->response()->setStatusCode(201);
    }

    public function show(DischargeMedicationReconciliationItem $record): DischargeMedicationReconciliationItemResource
    {
        return new DischargeMedicationReconciliationItemResource($record);
    }
}
