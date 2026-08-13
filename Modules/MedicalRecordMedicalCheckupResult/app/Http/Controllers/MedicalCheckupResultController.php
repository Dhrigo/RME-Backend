<?php

namespace Modules\MedicalRecordMedicalCheckupResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordMedicalCheckupResult\Http\Requests\StoreMedicalCheckupResultRequest;
use Modules\MedicalRecordMedicalCheckupResult\Http\Requests\UpdateMedicalCheckupResultRequest;
use Modules\MedicalRecordMedicalCheckupResult\Http\Resources\MedicalCheckupResultResource;
use Modules\MedicalRecordMedicalCheckupResult\Models\MedicalCheckupResult;

class MedicalCheckupResultController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicalCheckupResult::query();

        return MedicalCheckupResultResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMedicalCheckupResultRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'completed';

        $record = MedicalCheckupResult::create($data);

        return (new MedicalCheckupResultResource($record))->response()->setStatusCode(201);
    }

    public function show(MedicalCheckupResult $record): MedicalCheckupResultResource
    {
        return new MedicalCheckupResultResource($record);
    }

    public function update(UpdateMedicalCheckupResultRequest $request, MedicalCheckupResult $record): MedicalCheckupResultResource
    {
        $record->update($request->validated());

        return new MedicalCheckupResultResource($record);
    }

    public function destroy(MedicalCheckupResult $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
