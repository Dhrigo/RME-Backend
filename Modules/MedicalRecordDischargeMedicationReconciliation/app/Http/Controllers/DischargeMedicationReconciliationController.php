<?php

namespace Modules\MedicalRecordDischargeMedicationReconciliation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordDischargeMedicationReconciliation\Http\Requests\StoreDischargeMedicationReconciliationRequest;
use Modules\MedicalRecordDischargeMedicationReconciliation\Http\Resources\DischargeMedicationReconciliationResource;
use Modules\MedicalRecordDischargeMedicationReconciliation\Models\DischargeMedicationReconciliation;

class DischargeMedicationReconciliationController extends Controller
{
    public function index(Request $request)
    {
        $query = DischargeMedicationReconciliation::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return DischargeMedicationReconciliationResource::collection($query->latest('reconciled_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreDischargeMedicationReconciliationRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'draft';
        $data['reconciled_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = DischargeMedicationReconciliation::create($data);

        return (new DischargeMedicationReconciliationResource($record))->response()->setStatusCode(201);
    }

    public function show(DischargeMedicationReconciliation $record): DischargeMedicationReconciliationResource
    {
        return new DischargeMedicationReconciliationResource($record);
    }
}
