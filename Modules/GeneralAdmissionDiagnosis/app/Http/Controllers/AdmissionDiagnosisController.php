<?php

namespace Modules\GeneralAdmissionDiagnosis\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralAdmissionDiagnosis\Http\Requests\StoreAdmissionDiagnosisRequest;
use Modules\GeneralAdmissionDiagnosis\Http\Requests\UpdateAdmissionDiagnosisRequest;
use Modules\GeneralAdmissionDiagnosis\Http\Resources\AdmissionDiagnosisResource;
use Modules\GeneralAdmissionDiagnosis\Models\AdmissionDiagnosis;

class AdmissionDiagnosisController extends Controller
{
    public function index(Request $request)
    {
        $query = AdmissionDiagnosis::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return AdmissionDiagnosisResource::collection($query->latest('diagnosed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAdmissionDiagnosisRequest $request)
    {
        $data = $request->validated();
        $data['diagnosed_at'] ??= now();

        $diagnosis = AdmissionDiagnosis::create($data);

        return (new AdmissionDiagnosisResource($diagnosis))->response()->setStatusCode(201);
    }

    public function show(AdmissionDiagnosis $admission_diagnosis): AdmissionDiagnosisResource
    {
        return new AdmissionDiagnosisResource($admission_diagnosis);
    }

    public function update(UpdateAdmissionDiagnosisRequest $request, AdmissionDiagnosis $admission_diagnosis): AdmissionDiagnosisResource
    {
        $admission_diagnosis->update($request->validated());

        return new AdmissionDiagnosisResource($admission_diagnosis->fresh());
    }

    public function destroy(AdmissionDiagnosis $admission_diagnosis)
    {
        $admission_diagnosis->delete();

        return response()->json(null, 204);
    }
}
