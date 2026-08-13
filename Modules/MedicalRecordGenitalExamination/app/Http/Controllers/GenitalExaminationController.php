<?php

namespace Modules\MedicalRecordGenitalExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordGenitalExamination\Http\Requests\StoreGenitalExaminationRequest;
use Modules\MedicalRecordGenitalExamination\Http\Requests\UpdateGenitalExaminationRequest;
use Modules\MedicalRecordGenitalExamination\Http\Resources\GenitalExaminationResource;
use Modules\MedicalRecordGenitalExamination\Models\GenitalExamination;

class GenitalExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = GenitalExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return GenitalExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreGenitalExaminationRequest $request)
    {
        $data = $request->validated();
        $data['examined_at'] ??= now();

        $record = GenitalExamination::create($data);

        return (new GenitalExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(GenitalExamination $record): GenitalExaminationResource
    {
        return new GenitalExaminationResource($record);
    }

    public function update(UpdateGenitalExaminationRequest $request, GenitalExamination $record): GenitalExaminationResource
    {
        $record->update($request->validated());

        return new GenitalExaminationResource($record);
    }

    public function destroy(GenitalExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
