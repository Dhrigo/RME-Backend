<?php

namespace Modules\MedicalRecordAdmissionMedicationReconciliation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordAdmissionMedicationReconciliation\Http\Requests\StoreAdmissionMedicationReconciliationRequest;
use Modules\MedicalRecordAdmissionMedicationReconciliation\Http\Resources\AdmissionMedicationReconciliationResource;
use Modules\MedicalRecordAdmissionMedicationReconciliation\Models\AdmissionMedicationReconciliation;

class AdmissionMedicationReconciliationController extends Controller
{
    public function index(Request $request)
    {
        $query = AdmissionMedicationReconciliation::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return AdmissionMedicationReconciliationResource::collection($query->latest('reconciled_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAdmissionMedicationReconciliationRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'draft';
        $data['reconciled_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = AdmissionMedicationReconciliation::create($data);

        return (new AdmissionMedicationReconciliationResource($record))->response()->setStatusCode(201);
    }

    public function show(AdmissionMedicationReconciliation $record): AdmissionMedicationReconciliationResource
    {
        return new AdmissionMedicationReconciliationResource($record);
    }
}
