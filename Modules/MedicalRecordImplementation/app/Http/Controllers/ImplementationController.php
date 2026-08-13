<?php

namespace Modules\MedicalRecordImplementation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordImplementation\Http\Requests\StoreImplementationRequest;
use Modules\MedicalRecordImplementation\Http\Requests\UpdateImplementationRequest;
use Modules\MedicalRecordImplementation\Http\Resources\ImplementationResource;
use Modules\MedicalRecordImplementation\Models\Implementation;

class ImplementationController extends Controller
{
    public function index(Request $request)
    {
        $query = Implementation::query();

        return ImplementationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreImplementationRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'completed';

        $record = Implementation::create($data);

        return (new ImplementationResource($record))->response()->setStatusCode(201);
    }

    public function show(Implementation $record): ImplementationResource
    {
        return new ImplementationResource($record);
    }

    public function update(UpdateImplementationRequest $request, Implementation $record): ImplementationResource
    {
        $record->update($request->validated());

        return new ImplementationResource($record);
    }

    public function destroy(Implementation $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
