<?php

namespace Modules\MedicalRecordSurgeryPerformer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordSurgeryPerformer\Http\Requests\StoreSurgeryPerformerRequest;
use Modules\MedicalRecordSurgeryPerformer\Http\Requests\UpdateSurgeryPerformerRequest;
use Modules\MedicalRecordSurgeryPerformer\Http\Resources\SurgeryPerformerResource;
use Modules\MedicalRecordSurgeryPerformer\Models\SurgeryPerformer;

class SurgeryPerformerController extends Controller
{
    public function index(Request $request)
    {
        $query = SurgeryPerformer::query();

        if ($request->filled('surgery_id')) {
            $query->where('surgery_id', $request->integer('surgery_id'));
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->integer('doctor_id'));
        }

        return SurgeryPerformerResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreSurgeryPerformerRequest $request)
    {
        $record = SurgeryPerformer::create($request->validated());

        return (new SurgeryPerformerResource($record))->response()->setStatusCode(201);
    }

    public function show(SurgeryPerformer $record): SurgeryPerformerResource
    {
        return new SurgeryPerformerResource($record);
    }

    public function update(UpdateSurgeryPerformerRequest $request, SurgeryPerformer $record): SurgeryPerformerResource
    {
        $record->update($request->validated());

        return new SurgeryPerformerResource($record);
    }

    public function destroy(SurgeryPerformer $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
