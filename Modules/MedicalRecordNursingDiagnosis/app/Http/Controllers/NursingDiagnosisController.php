<?php

namespace Modules\MedicalRecordNursingDiagnosis\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordNursingDiagnosis\Http\Requests\StoreNursingDiagnosisRequest;
use Modules\MedicalRecordNursingDiagnosis\Http\Requests\UpdateNursingDiagnosisRequest;
use Modules\MedicalRecordNursingDiagnosis\Http\Resources\NursingDiagnosisResource;
use Modules\MedicalRecordNursingDiagnosis\Models\NursingDiagnosis;

class NursingDiagnosisController extends Controller
{
    public function index(Request $request)
    {
        $query = NursingDiagnosis::query();

        return NursingDiagnosisResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreNursingDiagnosisRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'active';

        $record = NursingDiagnosis::create($data);

        return (new NursingDiagnosisResource($record))->response()->setStatusCode(201);
    }

    public function show(NursingDiagnosis $record): NursingDiagnosisResource
    {
        return new NursingDiagnosisResource($record);
    }

    public function update(UpdateNursingDiagnosisRequest $request, NursingDiagnosis $record): NursingDiagnosisResource
    {
        $record->update($request->validated());

        return new NursingDiagnosisResource($record);
    }

    public function destroy(NursingDiagnosis $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
