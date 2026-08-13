<?php

namespace Modules\MedicalRecordEarExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordEarExamination\Http\Requests\StoreEarExaminationRequest;
use Modules\MedicalRecordEarExamination\Http\Requests\UpdateEarExaminationRequest;
use Modules\MedicalRecordEarExamination\Http\Resources\EarExaminationResource;
use Modules\MedicalRecordEarExamination\Models\EarExamination;

class EarExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = EarExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return EarExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreEarExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = EarExamination::create($data);

        return (new EarExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(EarExamination $record): EarExaminationResource
    {
        return new EarExaminationResource($record);
    }

    public function update(UpdateEarExaminationRequest $request, EarExamination $record): EarExaminationResource
    {
        $record->update($request->validated());

        return new EarExaminationResource($record);
    }

    public function destroy(EarExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
