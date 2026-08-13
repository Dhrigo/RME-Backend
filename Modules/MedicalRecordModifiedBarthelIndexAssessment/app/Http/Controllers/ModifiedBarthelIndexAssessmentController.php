<?php

namespace Modules\MedicalRecordModifiedBarthelIndexAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordModifiedBarthelIndexAssessment\Http\Requests\StoreModifiedBarthelIndexAssessmentRequest;
use Modules\MedicalRecordModifiedBarthelIndexAssessment\Http\Requests\UpdateModifiedBarthelIndexAssessmentRequest;
use Modules\MedicalRecordModifiedBarthelIndexAssessment\Http\Resources\ModifiedBarthelIndexAssessmentResource;
use Modules\MedicalRecordModifiedBarthelIndexAssessment\Models\ModifiedBarthelIndexAssessment;

class ModifiedBarthelIndexAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = ModifiedBarthelIndexAssessment::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ModifiedBarthelIndexAssessmentResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreModifiedBarthelIndexAssessmentRequest $request)
    {
        $data = $request->validated();

        $data['assessed_at'] ??= now();

        $record = ModifiedBarthelIndexAssessment::create($data);

        return (new ModifiedBarthelIndexAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(ModifiedBarthelIndexAssessment $record): ModifiedBarthelIndexAssessmentResource
    {
        return new ModifiedBarthelIndexAssessmentResource($record);
    }

    public function update(UpdateModifiedBarthelIndexAssessmentRequest $request, ModifiedBarthelIndexAssessment $record): ModifiedBarthelIndexAssessmentResource
    {
        $record->update($request->validated());

        return new ModifiedBarthelIndexAssessmentResource($record);
    }

    public function destroy(ModifiedBarthelIndexAssessment $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
