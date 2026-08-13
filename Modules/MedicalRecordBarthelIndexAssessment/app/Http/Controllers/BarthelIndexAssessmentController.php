<?php

namespace Modules\MedicalRecordBarthelIndexAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBarthelIndexAssessment\Http\Requests\StoreBarthelIndexAssessmentRequest;
use Modules\MedicalRecordBarthelIndexAssessment\Http\Requests\UpdateBarthelIndexAssessmentRequest;
use Modules\MedicalRecordBarthelIndexAssessment\Http\Resources\BarthelIndexAssessmentResource;
use Modules\MedicalRecordBarthelIndexAssessment\Models\BarthelIndexAssessment;

class BarthelIndexAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = BarthelIndexAssessment::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return BarthelIndexAssessmentResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreBarthelIndexAssessmentRequest $request)
    {
        $data = $request->validated();

        $data['assessed_at'] ??= now();

        $record = BarthelIndexAssessment::create($data);

        return (new BarthelIndexAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(BarthelIndexAssessment $record): BarthelIndexAssessmentResource
    {
        return new BarthelIndexAssessmentResource($record);
    }

    public function update(UpdateBarthelIndexAssessmentRequest $request, BarthelIndexAssessment $record): BarthelIndexAssessmentResource
    {
        $record->update($request->validated());

        return new BarthelIndexAssessmentResource($record);
    }

    public function destroy(BarthelIndexAssessment $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
