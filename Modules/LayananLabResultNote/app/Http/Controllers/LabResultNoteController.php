<?php

namespace Modules\LayananLabResultNote\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLabResultNote\Http\Requests\StoreLabResultNoteRequest;
use Modules\LayananLabResultNote\Http\Requests\UpdateLabResultNoteRequest;
use Modules\LayananLabResultNote\Http\Resources\LabResultNoteResource;
use Modules\LayananLabResultNote\Models\LabResultNote;

class LabResultNoteController extends Controller
{
    public function index(Request $request)
    {
        $query = LabResultNote::query();

        return LabResultNoteResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLabResultNoteRequest $request)
    {
        $data = $request->validated();

        $lab_note = LabResultNote::create($data);

        return (new LabResultNoteResource($lab_note))->response()->setStatusCode(201);
    }

    public function show(LabResultNote $lab_note): LabResultNoteResource
    {
        return new LabResultNoteResource($lab_note);
    }

    public function update(UpdateLabResultNoteRequest $request, LabResultNote $lab_note): LabResultNoteResource
    {
        $lab_note->update($request->validated());

        return new LabResultNoteResource($lab_note);
    }

    public function destroy(LabResultNote $lab_note)
    {
        $lab_note->delete();

        return response()->json(null, 204);
    }
}
