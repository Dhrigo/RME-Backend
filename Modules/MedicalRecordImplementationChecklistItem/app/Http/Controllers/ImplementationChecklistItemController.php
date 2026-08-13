<?php

namespace Modules\MedicalRecordImplementationChecklistItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordImplementationChecklistItem\Http\Requests\StoreImplementationChecklistItemRequest;
use Modules\MedicalRecordImplementationChecklistItem\Http\Requests\UpdateImplementationChecklistItemRequest;
use Modules\MedicalRecordImplementationChecklistItem\Http\Resources\ImplementationChecklistItemResource;
use Modules\MedicalRecordImplementationChecklistItem\Models\ImplementationChecklistItem;

class ImplementationChecklistItemController extends Controller
{
    public function index(Request $request)
    {
        $query = ImplementationChecklistItem::query();

        return ImplementationChecklistItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreImplementationChecklistItemRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] ??= true;

        $record = ImplementationChecklistItem::create($data);

        return (new ImplementationChecklistItemResource($record))->response()->setStatusCode(201);
    }

    public function show(ImplementationChecklistItem $record): ImplementationChecklistItemResource
    {
        return new ImplementationChecklistItemResource($record);
    }

    public function update(UpdateImplementationChecklistItemRequest $request, ImplementationChecklistItem $record): ImplementationChecklistItemResource
    {
        $record->update($request->validated());

        return new ImplementationChecklistItemResource($record);
    }

    public function destroy(ImplementationChecklistItem $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
