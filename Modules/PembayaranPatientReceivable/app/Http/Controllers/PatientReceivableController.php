<?php

namespace Modules\PembayaranPatientReceivable\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranPatientReceivable\Http\Requests\StorePatientReceivableRequest;
use Modules\PembayaranPatientReceivable\Http\Requests\UpdatePatientReceivableRequest;
use Modules\PembayaranPatientReceivable\Http\Resources\PatientReceivableResource;
use Modules\PembayaranPatientReceivable\Models\PatientReceivable;

class PatientReceivableController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientReceivable::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return PatientReceivableResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientReceivableRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'outstanding';

        $receivable = PatientReceivable::create($data);

        return (new PatientReceivableResource($receivable))->response()->setStatusCode(201);
    }

    public function show(PatientReceivable $patient_receivable): PatientReceivableResource
    {
        return new PatientReceivableResource($patient_receivable);
    }

    /**
     * Update is restricted to status transitions - amount/due_date are fixed at creation.
     */
    public function update(UpdatePatientReceivableRequest $request, PatientReceivable $patient_receivable): PatientReceivableResource
    {
        $patient_receivable->update($request->validated());

        return new PatientReceivableResource($patient_receivable->fresh());
    }
}
