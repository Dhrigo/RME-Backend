<?php

namespace Modules\MedicalRecordGynecologyUltrasound\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordGynecologyUltrasound\Http\Requests\GynecologyUltrasoundRequest;
use Modules\MedicalRecordGynecologyUltrasound\Http\Resources\GynecologyUltrasoundResource;
use Modules\MedicalRecordGynecologyUltrasound\Models\GynecologyUltrasound;

class GynecologyUltrasoundController extends Controller
{
    public function index(Request $request)
    {
        $query = GynecologyUltrasound::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->integer('doctor_id'));
        }

        return GynecologyUltrasoundResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(GynecologyUltrasoundRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()?->id;

        $ultrasound = GynecologyUltrasound::create($data);

        return (new GynecologyUltrasoundResource($ultrasound))->response()->setStatusCode(201);
    }

    public function show(GynecologyUltrasound $ultrasound): GynecologyUltrasoundResource
    {
        return new GynecologyUltrasoundResource($ultrasound);
    }

    public function update(GynecologyUltrasoundRequest $request, GynecologyUltrasound $ultrasound): GynecologyUltrasoundResource
    {
        $ultrasound->update($request->validated());

        return new GynecologyUltrasoundResource($ultrasound);
    }

    public function destroy(GynecologyUltrasound $ultrasound)
    {
        $ultrasound->delete();

        return response()->json(['message' => 'Gynecology ultrasound record deleted successfully']);
    }
}
