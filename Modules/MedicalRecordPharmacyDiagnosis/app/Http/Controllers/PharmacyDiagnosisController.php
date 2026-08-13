<?php

namespace Modules\MedicalRecordPharmacyDiagnosis\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordPharmacyDiagnosis\Http\Requests\StorePharmacyDiagnosisRequest;
use Modules\MedicalRecordPharmacyDiagnosis\Http\Requests\UpdatePharmacyDiagnosisRequest;
use Modules\MedicalRecordPharmacyDiagnosis\Http\Resources\PharmacyDiagnosisResource;
use Modules\MedicalRecordPharmacyDiagnosis\Models\PharmacyDiagnosis;

class PharmacyDiagnosisController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyDiagnosis::query();

        return PharmacyDiagnosisResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyDiagnosisRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'active';

        $record = PharmacyDiagnosis::create($data);

        return (new PharmacyDiagnosisResource($record))->response()->setStatusCode(201);
    }

    public function show(PharmacyDiagnosis $record): PharmacyDiagnosisResource
    {
        return new PharmacyDiagnosisResource($record);
    }

    public function update(UpdatePharmacyDiagnosisRequest $request, PharmacyDiagnosis $record): PharmacyDiagnosisResource
    {
        $record->update($request->validated());

        return new PharmacyDiagnosisResource($record);
    }

    public function destroy(PharmacyDiagnosis $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
