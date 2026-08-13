<?php

namespace Modules\MedicalRecordChiefComplaint\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordChiefComplaint\Http\Requests\StoreChiefComplaintRequest;
use Modules\MedicalRecordChiefComplaint\Http\Requests\UpdateChiefComplaintRequest;
use Modules\MedicalRecordChiefComplaint\Http\Resources\ChiefComplaintResource;
use Modules\MedicalRecordChiefComplaint\Models\ChiefComplaint;

class ChiefComplaintController extends Controller
{
    public function index(Request $request)
    {
        $query = ChiefComplaint::query();

        return ChiefComplaintResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreChiefComplaintRequest $request)
    {
        $data = $request->validated();

        $record = ChiefComplaint::create($data);

        return (new ChiefComplaintResource($record))->response()->setStatusCode(201);
    }

    public function show(ChiefComplaint $record): ChiefComplaintResource
    {
        return new ChiefComplaintResource($record);
    }

    public function update(UpdateChiefComplaintRequest $request, ChiefComplaint $record): ChiefComplaintResource
    {
        $record->update($request->validated());

        return new ChiefComplaintResource($record);
    }

    public function destroy(ChiefComplaint $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
