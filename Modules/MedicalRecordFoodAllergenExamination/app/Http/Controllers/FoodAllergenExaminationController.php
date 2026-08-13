<?php

namespace Modules\MedicalRecordFoodAllergenExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordFoodAllergenExamination\Http\Requests\StoreFoodAllergenExaminationRequest;
use Modules\MedicalRecordFoodAllergenExamination\Http\Requests\UpdateFoodAllergenExaminationRequest;
use Modules\MedicalRecordFoodAllergenExamination\Http\Resources\FoodAllergenExaminationResource;
use Modules\MedicalRecordFoodAllergenExamination\Models\FoodAllergenExamination;

class FoodAllergenExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = FoodAllergenExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return FoodAllergenExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreFoodAllergenExaminationRequest $request)
    {
        $data = $request->validated();
        $data['examined_at'] ??= now();

        $record = FoodAllergenExamination::create($data);

        return (new FoodAllergenExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(FoodAllergenExamination $record): FoodAllergenExaminationResource
    {
        return new FoodAllergenExaminationResource($record);
    }

    public function update(UpdateFoodAllergenExaminationRequest $request, FoodAllergenExamination $record): FoodAllergenExaminationResource
    {
        $record->update($request->validated());

        return new FoodAllergenExaminationResource($record);
    }

    public function destroy(FoodAllergenExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
