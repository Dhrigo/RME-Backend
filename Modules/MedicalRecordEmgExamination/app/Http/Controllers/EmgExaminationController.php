<?php

namespace Modules\MedicalRecordEmgExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordEmgExamination\Http\Requests\StoreEmgExaminationRequest;
use Modules\MedicalRecordEmgExamination\Http\Requests\UpdateEmgExaminationRequest;
use Modules\MedicalRecordEmgExamination\Http\Resources\EmgExaminationResource;
use Modules\MedicalRecordEmgExamination\Models\EmgExamination;

class EmgExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = EmgExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return EmgExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreEmgExaminationRequest $request)
    {
        $data = $request->validated();
        $data['examined_at'] ??= now();

        $record = EmgExamination::create($data);

        return (new EmgExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(EmgExamination $record): EmgExaminationResource
    {
        return new EmgExaminationResource($record);
    }

    public function update(UpdateEmgExaminationRequest $request, EmgExamination $record): EmgExaminationResource
    {
        $record->update($request->validated());

        return new EmgExaminationResource($record);
    }

    public function destroy(EmgExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
