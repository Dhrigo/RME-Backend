<?php

namespace Modules\MedicalRecordHemodialysisLetter\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordHemodialysisLetter\Http\Requests\HemodialysisLetterRequest;
use Modules\MedicalRecordHemodialysisLetter\Http\Resources\HemodialysisLetterResource;
use Modules\MedicalRecordHemodialysisLetter\Models\HemodialysisLetter;

class HemodialysisLetterController extends Controller
{
    public function index(Request $request)
    {
        $query = HemodialysisLetter::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->integer('doctor_id'));
        }

        return HemodialysisLetterResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(HemodialysisLetterRequest $request)
    {
        $data = $request->validated();
        $data['hd_frequency_per_week'] ??= 2;
        $data['created_by'] = $request->user()?->id;

        $letter = HemodialysisLetter::create($data);

        return (new HemodialysisLetterResource($letter))->response()->setStatusCode(201);
    }

    public function show(HemodialysisLetter $letter): HemodialysisLetterResource
    {
        return new HemodialysisLetterResource($letter);
    }

    public function update(HemodialysisLetterRequest $request, HemodialysisLetter $letter): HemodialysisLetterResource
    {
        $letter->update($request->validated());

        return new HemodialysisLetterResource($letter);
    }

    public function destroy(HemodialysisLetter $letter)
    {
        $letter->delete();

        return response()->json(['message' => 'Hemodialysis letter deleted successfully']);
    }
}
