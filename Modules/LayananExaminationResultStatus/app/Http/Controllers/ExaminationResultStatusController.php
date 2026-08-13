<?php

namespace Modules\LayananExaminationResultStatus\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananExaminationResultStatus\Http\Requests\StoreExaminationResultStatusRequest;
use Modules\LayananExaminationResultStatus\Http\Requests\UpdateExaminationResultStatusRequest;
use Modules\LayananExaminationResultStatus\Http\Resources\ExaminationResultStatusResource;
use Modules\LayananExaminationResultStatus\Models\ExaminationResultStatus;

class ExaminationResultStatusController extends Controller
{
    public function index(Request $request)
    {
        $query = ExaminationResultStatus::query();

        return ExaminationResultStatusResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreExaminationResultStatusRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'pending';

        $record = ExaminationResultStatus::create($data);

        return (new ExaminationResultStatusResource($record))->response()->setStatusCode(201);
    }

    public function show(ExaminationResultStatus $record): ExaminationResultStatusResource
    {
        return new ExaminationResultStatusResource($record);
    }

    public function update(UpdateExaminationResultStatusRequest $request, ExaminationResultStatus $record): ExaminationResultStatusResource
    {
        $record->update($request->validated());

        return new ExaminationResultStatusResource($record);
    }

    public function destroy(ExaminationResultStatus $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
