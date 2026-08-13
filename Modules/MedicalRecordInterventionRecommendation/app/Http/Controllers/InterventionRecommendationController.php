<?php

namespace Modules\MedicalRecordInterventionRecommendation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordInterventionRecommendation\Http\Requests\StoreInterventionRecommendationRequest;
use Modules\MedicalRecordInterventionRecommendation\Http\Requests\UpdateInterventionRecommendationRequest;
use Modules\MedicalRecordInterventionRecommendation\Http\Resources\InterventionRecommendationResource;
use Modules\MedicalRecordInterventionRecommendation\Models\InterventionRecommendation;

class InterventionRecommendationController extends Controller
{
    public function index(Request $request)
    {
        $query = InterventionRecommendation::query();

        return InterventionRecommendationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreInterventionRecommendationRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'open';

        $record = InterventionRecommendation::create($data);

        return (new InterventionRecommendationResource($record))->response()->setStatusCode(201);
    }

    public function show(InterventionRecommendation $record): InterventionRecommendationResource
    {
        return new InterventionRecommendationResource($record);
    }

    public function update(UpdateInterventionRecommendationRequest $request, InterventionRecommendation $record): InterventionRecommendationResource
    {
        $record->update($request->validated());

        return new InterventionRecommendationResource($record);
    }

    public function destroy(InterventionRecommendation $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
