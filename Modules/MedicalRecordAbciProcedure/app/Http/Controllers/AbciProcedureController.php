<?php

namespace Modules\MedicalRecordAbciProcedure\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordAbciProcedure\Http\Requests\AbciProcedureRequest;
use Modules\MedicalRecordAbciProcedure\Http\Resources\AbciProcedureResource;
use Modules\MedicalRecordAbciProcedure\Models\AbciProcedure;

class AbciProcedureController extends Controller
{
    public function index(Request $request)
    {
        $query = AbciProcedure::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->integer('doctor_id'));
        }

        return AbciProcedureResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(AbciProcedureRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()?->id;

        $procedure = AbciProcedure::create($data);

        return (new AbciProcedureResource($procedure))->response()->setStatusCode(201);
    }

    public function show(AbciProcedure $procedure): AbciProcedureResource
    {
        return new AbciProcedureResource($procedure);
    }

    public function update(AbciProcedureRequest $request, AbciProcedure $procedure): AbciProcedureResource
    {
        $procedure->update($request->validated());

        return new AbciProcedureResource($procedure);
    }

    public function destroy(AbciProcedure $procedure)
    {
        $procedure->delete();

        return response()->json(['message' => 'ABCI procedure record deleted successfully']);
    }
}
