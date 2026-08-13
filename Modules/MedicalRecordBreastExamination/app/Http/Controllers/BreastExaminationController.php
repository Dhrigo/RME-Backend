<?php

namespace Modules\MedicalRecordBreastExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBreastExamination\Http\Requests\StoreBreastExaminationRequest;
use Modules\MedicalRecordBreastExamination\Http\Requests\UpdateBreastExaminationRequest;
use Modules\MedicalRecordBreastExamination\Http\Resources\BreastExaminationResource;
use Modules\MedicalRecordBreastExamination\Models\BreastExamination;

class BreastExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = BreastExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return BreastExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreBreastExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = BreastExamination::create($data);

        return (new BreastExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(BreastExamination $record): BreastExaminationResource
    {
        return new BreastExaminationResource($record);
    }

    public function update(UpdateBreastExaminationRequest $request, BreastExamination $record): BreastExaminationResource
    {
        $record->update($request->validated());

        return new BreastExaminationResource($record);
    }

    public function destroy(BreastExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
