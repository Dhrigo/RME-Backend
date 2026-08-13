<?php

namespace Modules\MedicalRecordUpperArmExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordUpperArmExamination\Http\Requests\StoreUpperArmExaminationRequest;
use Modules\MedicalRecordUpperArmExamination\Http\Requests\UpdateUpperArmExaminationRequest;
use Modules\MedicalRecordUpperArmExamination\Http\Resources\UpperArmExaminationResource;
use Modules\MedicalRecordUpperArmExamination\Models\UpperArmExamination;

class UpperArmExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = UpperArmExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return UpperArmExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreUpperArmExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = UpperArmExamination::create($data);

        return (new UpperArmExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(UpperArmExamination $record): UpperArmExaminationResource
    {
        return new UpperArmExaminationResource($record);
    }

    public function update(UpdateUpperArmExaminationRequest $request, UpperArmExamination $record): UpperArmExaminationResource
    {
        $record->update($request->validated());

        return new UpperArmExaminationResource($record);
    }

    public function destroy(UpperArmExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
