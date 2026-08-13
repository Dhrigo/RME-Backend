<?php

namespace Modules\MedicalRecordHairExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordHairExamination\Http\Requests\StoreHairExaminationRequest;
use Modules\MedicalRecordHairExamination\Http\Requests\UpdateHairExaminationRequest;
use Modules\MedicalRecordHairExamination\Http\Resources\HairExaminationResource;
use Modules\MedicalRecordHairExamination\Models\HairExamination;

class HairExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = HairExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return HairExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreHairExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = HairExamination::create($data);

        return (new HairExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(HairExamination $record): HairExaminationResource
    {
        return new HairExaminationResource($record);
    }

    public function update(UpdateHairExaminationRequest $request, HairExamination $record): HairExaminationResource
    {
        $record->update($request->validated());

        return new HairExaminationResource($record);
    }

    public function destroy(HairExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
