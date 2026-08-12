<?php

namespace Modules\MedicalRecordDiagnosis\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordDiagnosis\Http\Requests\StoreDiagnosisRequest;
use Modules\MedicalRecordDiagnosis\Http\Resources\DiagnosisResource;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;

class DiagnosisController extends Controller
{
    public function index(Request $request)
    {
        $query = Diagnosis::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return DiagnosisResource::collection($query->latest('recorded_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreDiagnosisRequest $request)
    {
        $data = $request->validated();
        $data['recorded_at'] ??= now();
        $data['recorded_by'] = $request->user()->id;

        if ($data['is_primary'] ?? false) {
            Diagnosis::where('visit_id', $data['visit_id'])->update(['is_primary' => false]);
        }

        $diagnosis = Diagnosis::create($data);

        return (new DiagnosisResource($diagnosis))->response()->setStatusCode(201);
    }

    public function show(Diagnosis $diagnosis): DiagnosisResource
    {
        return new DiagnosisResource($diagnosis);
    }

    public function destroy(Diagnosis $diagnosis)
    {
        $diagnosis->delete();

        return response()->json(null, 204);
    }
}
