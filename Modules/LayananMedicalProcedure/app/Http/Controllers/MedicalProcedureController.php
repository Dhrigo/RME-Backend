<?php

namespace Modules\LayananMedicalProcedure\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananMedicalProcedure\Http\Requests\StoreMedicalProcedureRequest;
use Modules\LayananMedicalProcedure\Http\Requests\UpdateMedicalProcedureRequest;
use Modules\LayananMedicalProcedure\Http\Resources\MedicalProcedureResource;
use Modules\LayananMedicalProcedure\Models\MedicalProcedure;

class MedicalProcedureController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicalProcedure::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return MedicalProcedureResource::collection($query->latest('performed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMedicalProcedureRequest $request)
    {
        $data = $request->validated();
        $data['performed_at'] ??= now();
        $data['status'] ??= 'completed';
        $data['created_by'] = $request->user()->id;

        $procedure = MedicalProcedure::create($data);

        return (new MedicalProcedureResource($procedure))->response()->setStatusCode(201);
    }

    public function show(MedicalProcedure $medical_procedure): MedicalProcedureResource
    {
        return new MedicalProcedureResource($medical_procedure);
    }

    /**
     * Only status/notes are correctable - what was done and when is not.
     */
    public function update(UpdateMedicalProcedureRequest $request, MedicalProcedure $medical_procedure): MedicalProcedureResource
    {
        $medical_procedure->update($request->validated());

        return new MedicalProcedureResource($medical_procedure);
    }
}
