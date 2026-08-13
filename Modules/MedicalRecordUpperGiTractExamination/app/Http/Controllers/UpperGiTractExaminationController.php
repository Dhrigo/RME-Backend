<?php

namespace Modules\MedicalRecordUpperGiTractExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordUpperGiTractExamination\Http\Requests\StoreUpperGiTractExaminationRequest;
use Modules\MedicalRecordUpperGiTractExamination\Http\Requests\UpdateUpperGiTractExaminationRequest;
use Modules\MedicalRecordUpperGiTractExamination\Http\Resources\UpperGiTractExaminationResource;
use Modules\MedicalRecordUpperGiTractExamination\Models\UpperGiTractExamination;

class UpperGiTractExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = UpperGiTractExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return UpperGiTractExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreUpperGiTractExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = UpperGiTractExamination::create($data);

        return (new UpperGiTractExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(UpperGiTractExamination $record): UpperGiTractExaminationResource
    {
        return new UpperGiTractExaminationResource($record);
    }

    public function update(UpdateUpperGiTractExaminationRequest $request, UpperGiTractExamination $record): UpperGiTractExaminationResource
    {
        $record->update($request->validated());

        return new UpperGiTractExaminationResource($record);
    }

    public function destroy(UpperGiTractExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
