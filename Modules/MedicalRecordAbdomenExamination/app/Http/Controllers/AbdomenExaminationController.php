<?php

namespace Modules\MedicalRecordAbdomenExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordAbdomenExamination\Http\Requests\StoreAbdomenExaminationRequest;
use Modules\MedicalRecordAbdomenExamination\Http\Requests\UpdateAbdomenExaminationRequest;
use Modules\MedicalRecordAbdomenExamination\Http\Resources\AbdomenExaminationResource;
use Modules\MedicalRecordAbdomenExamination\Models\AbdomenExamination;

class AbdomenExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = AbdomenExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return AbdomenExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreAbdomenExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = AbdomenExamination::create($data);

        return (new AbdomenExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(AbdomenExamination $record): AbdomenExaminationResource
    {
        return new AbdomenExaminationResource($record);
    }

    public function update(UpdateAbdomenExaminationRequest $request, AbdomenExamination $record): AbdomenExaminationResource
    {
        $record->update($request->validated());

        return new AbdomenExaminationResource($record);
    }

    public function destroy(AbdomenExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
