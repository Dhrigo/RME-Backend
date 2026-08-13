<?php

namespace Modules\MedicalRecordPediatricStatus\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordPediatricStatus\Http\Requests\PediatricStatusRequest;
use Modules\MedicalRecordPediatricStatus\Http\Resources\PediatricStatusResource;
use Modules\MedicalRecordPediatricStatus\Models\PediatricStatus;

class PediatricStatusController extends Controller
{
    public function index(Request $request)
    {
        $query = PediatricStatus::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PediatricStatusResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(PediatricStatusRequest $request)
    {
        $data = $request->validated();
        $data['recorded_at'] ??= now();
        $data['created_by'] = $request->user()?->id;

        $status = PediatricStatus::create($data);

        return (new PediatricStatusResource($status))->response()->setStatusCode(201);
    }

    public function show(PediatricStatus $status): PediatricStatusResource
    {
        return new PediatricStatusResource($status);
    }

    public function update(PediatricStatusRequest $request, PediatricStatus $status): PediatricStatusResource
    {
        $status->update($request->validated());

        return new PediatricStatusResource($status);
    }

    public function destroy(PediatricStatus $status)
    {
        $status->delete();

        return response()->json(['message' => 'Pediatric status record deleted successfully']);
    }
}
