<?php

namespace Modules\GeneralReference\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralReference\Http\Requests\StoreReferenceRequest;
use Modules\GeneralReference\Http\Requests\UpdateReferenceRequest;
use Modules\GeneralReference\Http\Resources\ReferenceResource;
use Modules\GeneralReference\Models\Reference;

class ReferenceController extends Controller
{
    public function index(Request $request)
    {
        $query = Reference::query();

        return ReferenceResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreReferenceRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $data['is_active'] ?? true;
        $reference_entry = Reference::create($data);

        return (new ReferenceResource($reference_entry))->response()->setStatusCode(201);
    }

    public function show(Reference $reference_entry): ReferenceResource
    {
        return new ReferenceResource($reference_entry);
    }

    public function update(UpdateReferenceRequest $request, Reference $reference_entry): ReferenceResource
    {
        $reference_entry->update($request->validated());

        return new ReferenceResource($reference_entry);
    }

    public function destroy(Reference $reference_entry)
    {
        $reference_entry->delete();

        return response()->json(null, 204);
    }
}
