<?php

namespace Modules\MedicalRecordIcd10Code\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordIcd10Code\Http\Requests\StoreIcd10CodeRequest;
use Modules\MedicalRecordIcd10Code\Http\Requests\UpdateIcd10CodeRequest;
use Modules\MedicalRecordIcd10Code\Http\Resources\Icd10CodeResource;
use Modules\MedicalRecordIcd10Code\Models\Icd10Code;

class Icd10CodeController extends Controller
{
    public function index(Request $request)
    {
        $query = Icd10Code::query();

        return Icd10CodeResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreIcd10CodeRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] ??= true;

        $record = Icd10Code::create($data);

        return (new Icd10CodeResource($record))->response()->setStatusCode(201);
    }

    public function show(Icd10Code $record): Icd10CodeResource
    {
        return new Icd10CodeResource($record);
    }

    public function update(UpdateIcd10CodeRequest $request, Icd10Code $record): Icd10CodeResource
    {
        $record->update($request->validated());

        return new Icd10CodeResource($record);
    }

    public function destroy(Icd10Code $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
