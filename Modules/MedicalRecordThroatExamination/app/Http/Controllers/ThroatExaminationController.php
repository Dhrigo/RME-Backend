<?php

namespace Modules\MedicalRecordThroatExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordThroatExamination\Http\Requests\StoreThroatExaminationRequest;
use Modules\MedicalRecordThroatExamination\Http\Requests\UpdateThroatExaminationRequest;
use Modules\MedicalRecordThroatExamination\Http\Resources\ThroatExaminationResource;
use Modules\MedicalRecordThroatExamination\Models\ThroatExamination;

class ThroatExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = ThroatExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ThroatExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreThroatExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = ThroatExamination::create($data);

        return (new ThroatExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(ThroatExamination $record): ThroatExaminationResource
    {
        return new ThroatExaminationResource($record);
    }

    public function update(UpdateThroatExaminationRequest $request, ThroatExamination $record): ThroatExaminationResource
    {
        $record->update($request->validated());

        return new ThroatExaminationResource($record);
    }

    public function destroy(ThroatExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
