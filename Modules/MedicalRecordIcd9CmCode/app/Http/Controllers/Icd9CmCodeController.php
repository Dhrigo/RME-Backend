<?php

namespace Modules\MedicalRecordIcd9CmCode\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordIcd9CmCode\Http\Requests\StoreIcd9CmCodeRequest;
use Modules\MedicalRecordIcd9CmCode\Http\Requests\UpdateIcd9CmCodeRequest;
use Modules\MedicalRecordIcd9CmCode\Http\Resources\Icd9CmCodeResource;
use Modules\MedicalRecordIcd9CmCode\Models\Icd9CmCode;

class Icd9CmCodeController extends Controller
{
    public function index(Request $request)
    {
        $query = Icd9CmCode::query();

        return Icd9CmCodeResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreIcd9CmCodeRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] ??= true;

        $record = Icd9CmCode::create($data);

        return (new Icd9CmCodeResource($record))->response()->setStatusCode(201);
    }

    public function show(Icd9CmCode $record): Icd9CmCodeResource
    {
        return new Icd9CmCodeResource($record);
    }

    public function update(UpdateIcd9CmCodeRequest $request, Icd9CmCode $record): Icd9CmCodeResource
    {
        $record->update($request->validated());

        return new Icd9CmCodeResource($record);
    }

    public function destroy(Icd9CmCode $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
