<?php

namespace Modules\MedicalRecordProcedureSurgery\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordProcedureSurgery\Http\Requests\StoreProcedureSurgeryRequest;
use Modules\MedicalRecordProcedureSurgery\Http\Requests\UpdateProcedureSurgeryRequest;
use Modules\MedicalRecordProcedureSurgery\Http\Resources\ProcedureSurgeryResource;
use Modules\MedicalRecordProcedureSurgery\Models\ProcedureSurgery;

class ProcedureSurgeryController extends Controller
{
    public function index(Request $request)
    {
        $query = ProcedureSurgery::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ProcedureSurgeryResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreProcedureSurgeryRequest $request)
    {
        $data = $request->validated();
        $data['performed_at'] ??= now();

        $record = ProcedureSurgery::create($data);

        return (new ProcedureSurgeryResource($record))->response()->setStatusCode(201);
    }

    public function show(ProcedureSurgery $record): ProcedureSurgeryResource
    {
        return new ProcedureSurgeryResource($record);
    }

    public function update(UpdateProcedureSurgeryRequest $request, ProcedureSurgery $record): ProcedureSurgeryResource
    {
        $record->update($request->validated());

        return new ProcedureSurgeryResource($record);
    }

    public function destroy(ProcedureSurgery $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
