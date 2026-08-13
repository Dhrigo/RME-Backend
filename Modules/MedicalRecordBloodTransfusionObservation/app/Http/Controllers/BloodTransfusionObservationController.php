<?php

namespace Modules\MedicalRecordBloodTransfusionObservation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBloodTransfusionObservation\Http\Requests\StoreBloodTransfusionObservationRequest;
use Modules\MedicalRecordBloodTransfusionObservation\Http\Requests\UpdateBloodTransfusionObservationRequest;
use Modules\MedicalRecordBloodTransfusionObservation\Http\Resources\BloodTransfusionObservationResource;
use Modules\MedicalRecordBloodTransfusionObservation\Models\BloodTransfusionObservation;

class BloodTransfusionObservationController extends Controller
{
    public function index(Request $request)
    {
        $query = BloodTransfusionObservation::query();


        if ($request->filled('blood_transfusion_id')) {
            $query->where('blood_transfusion_id', $request->integer('blood_transfusion_id'));
        }

        return BloodTransfusionObservationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreBloodTransfusionObservationRequest $request)
    {
        $data = $request->validated();

        $data['observed_at'] ??= now();

        $record = BloodTransfusionObservation::create($data);

        return (new BloodTransfusionObservationResource($record))->response()->setStatusCode(201);
    }

    public function show(BloodTransfusionObservation $record): BloodTransfusionObservationResource
    {
        return new BloodTransfusionObservationResource($record);
    }

    public function update(UpdateBloodTransfusionObservationRequest $request, BloodTransfusionObservation $record): BloodTransfusionObservationResource
    {
        $record->update($request->validated());

        return new BloodTransfusionObservationResource($record);
    }

    public function destroy(BloodTransfusionObservation $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
