<?php

namespace Modules\MedicalRecordSkinPrickTestExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordSkinPrickTestExamination\Http\Requests\StoreSkinPrickTestExaminationRequest;
use Modules\MedicalRecordSkinPrickTestExamination\Http\Requests\UpdateSkinPrickTestExaminationRequest;
use Modules\MedicalRecordSkinPrickTestExamination\Http\Resources\SkinPrickTestExaminationResource;
use Modules\MedicalRecordSkinPrickTestExamination\Models\SkinPrickTestExamination;

class SkinPrickTestExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = SkinPrickTestExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return SkinPrickTestExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreSkinPrickTestExaminationRequest $request)
    {
        $data = $request->validated();

        $data['tested_at'] ??= now();

        $record = SkinPrickTestExamination::create($data);

        return (new SkinPrickTestExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(SkinPrickTestExamination $record): SkinPrickTestExaminationResource
    {
        return new SkinPrickTestExaminationResource($record);
    }

    public function update(UpdateSkinPrickTestExaminationRequest $request, SkinPrickTestExamination $record): SkinPrickTestExaminationResource
    {
        $record->update($request->validated());

        return new SkinPrickTestExaminationResource($record);
    }

    public function destroy(SkinPrickTestExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
