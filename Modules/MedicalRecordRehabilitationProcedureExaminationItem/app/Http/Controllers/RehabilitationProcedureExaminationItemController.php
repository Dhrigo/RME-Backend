<?php

namespace Modules\MedicalRecordRehabilitationProcedureExaminationItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordRehabilitationProcedureExaminationItem\Http\Requests\StoreRehabilitationProcedureExaminationItemRequest;
use Modules\MedicalRecordRehabilitationProcedureExaminationItem\Http\Requests\UpdateRehabilitationProcedureExaminationItemRequest;
use Modules\MedicalRecordRehabilitationProcedureExaminationItem\Http\Resources\RehabilitationProcedureExaminationItemResource;
use Modules\MedicalRecordRehabilitationProcedureExaminationItem\Models\RehabilitationProcedureExaminationItem;

class RehabilitationProcedureExaminationItemController extends Controller
{
    public function index(Request $request)
    {
        $query = RehabilitationProcedureExaminationItem::query();


        if ($request->filled('rehabilitation_procedure_examination_id')) {
            $query->where('rehabilitation_procedure_examination_id', $request->integer('rehabilitation_procedure_examination_id'));
        }

        return RehabilitationProcedureExaminationItemResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreRehabilitationProcedureExaminationItemRequest $request)
    {
        $data = $request->validated();

        $record = RehabilitationProcedureExaminationItem::create($data);

        return (new RehabilitationProcedureExaminationItemResource($record))->response()->setStatusCode(201);
    }

    public function show(RehabilitationProcedureExaminationItem $record): RehabilitationProcedureExaminationItemResource
    {
        return new RehabilitationProcedureExaminationItemResource($record);
    }

    public function update(UpdateRehabilitationProcedureExaminationItemRequest $request, RehabilitationProcedureExaminationItem $record): RehabilitationProcedureExaminationItemResource
    {
        $record->update($request->validated());

        return new RehabilitationProcedureExaminationItemResource($record);
    }

    public function destroy(RehabilitationProcedureExaminationItem $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
