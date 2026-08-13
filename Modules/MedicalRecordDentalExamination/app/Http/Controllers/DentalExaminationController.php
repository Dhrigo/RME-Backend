<?php

namespace Modules\MedicalRecordDentalExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordDentalExamination\Http\Requests\StoreDentalExaminationRequest;
use Modules\MedicalRecordDentalExamination\Http\Requests\UpdateDentalExaminationRequest;
use Modules\MedicalRecordDentalExamination\Http\Resources\DentalExaminationResource;
use Modules\MedicalRecordDentalExamination\Models\DentalExamination;

class DentalExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = DentalExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return DentalExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreDentalExaminationRequest $request)
    {
        $data = $request->validated();
        $data['decayed_teeth_count'] ??= 0;
        $data['missing_teeth_count'] ??= 0;
        $data['filled_teeth_count'] ??= 0;
        $data['examined_at'] ??= now();

        $record = DentalExamination::create($data);

        return (new DentalExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(DentalExamination $record): DentalExaminationResource
    {
        return new DentalExaminationResource($record);
    }

    public function update(UpdateDentalExaminationRequest $request, DentalExamination $record): DentalExaminationResource
    {
        $record->update($request->validated());

        return new DentalExaminationResource($record);
    }

    public function destroy(DentalExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
