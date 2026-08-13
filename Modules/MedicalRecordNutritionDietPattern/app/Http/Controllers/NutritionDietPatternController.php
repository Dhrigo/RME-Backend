<?php

namespace Modules\MedicalRecordNutritionDietPattern\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordNutritionDietPattern\Http\Requests\StoreNutritionDietPatternRequest;
use Modules\MedicalRecordNutritionDietPattern\Http\Resources\NutritionDietPatternResource;
use Modules\MedicalRecordNutritionDietPattern\Models\NutritionDietPattern;

class NutritionDietPatternController extends Controller
{
    public function index(Request $request)
    {
        $query = NutritionDietPattern::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return NutritionDietPatternResource::collection($query->latest('assessed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreNutritionDietPatternRequest $request)
    {
        $data = $request->validated();
        $data['assessed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = NutritionDietPattern::create($data);

        return (new NutritionDietPatternResource($record))->response()->setStatusCode(201);
    }

    public function show(NutritionDietPattern $record): NutritionDietPatternResource
    {
        return new NutritionDietPatternResource($record);
    }
}
