<?php

namespace Modules\MedicalRecordDoctorProcedureConsent\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordDoctorProcedureConsent\Http\Requests\StoreDoctorProcedureConsentRequest;
use Modules\MedicalRecordDoctorProcedureConsent\Http\Resources\DoctorProcedureConsentResource;
use Modules\MedicalRecordDoctorProcedureConsent\Models\DoctorProcedureConsent;

class DoctorProcedureConsentController extends Controller
{
    public function index(Request $request)
    {
        $query = DoctorProcedureConsent::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return DoctorProcedureConsentResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreDoctorProcedureConsentRequest $request)
    {
        $data = $request->validated();
        $data['consent_decision'] ??= 'pending';
        $data['created_by'] = $request->user()->id;

        $record = DoctorProcedureConsent::create($data);

        return (new DoctorProcedureConsentResource($record))->response()->setStatusCode(201);
    }

    public function show(DoctorProcedureConsent $record): DoctorProcedureConsentResource
    {
        return new DoctorProcedureConsentResource($record);
    }
}
