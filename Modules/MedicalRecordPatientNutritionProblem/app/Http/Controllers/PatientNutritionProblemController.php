<?php

namespace Modules\MedicalRecordPatientNutritionProblem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordPatientNutritionProblem\Http\Requests\StorePatientNutritionProblemRequest;
use Modules\MedicalRecordPatientNutritionProblem\Http\Resources\PatientNutritionProblemResource;
use Modules\MedicalRecordPatientNutritionProblem\Models\PatientNutritionProblem;

class PatientNutritionProblemController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientNutritionProblem::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PatientNutritionProblemResource::collection($query->latest('identified_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientNutritionProblemRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'open';
        $data['identified_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = PatientNutritionProblem::create($data);

        return (new PatientNutritionProblemResource($record))->response()->setStatusCode(201);
    }

    public function show(PatientNutritionProblem $record): PatientNutritionProblemResource
    {
        return new PatientNutritionProblemResource($record);
    }
}
