<?php

namespace Modules\LayananPharmacyReturn\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPharmacyReturn\Http\Requests\StorePharmacyReturnRequest;
use Modules\LayananPharmacyReturn\Http\Requests\UpdatePharmacyReturnRequest;
use Modules\LayananPharmacyReturn\Http\Resources\PharmacyReturnResource;
use Modules\LayananPharmacyReturn\Models\PharmacyReturn;

class PharmacyReturnController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyReturn::query();

        return PharmacyReturnResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyReturnRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'pending';

        $record = PharmacyReturn::create($data);

        return (new PharmacyReturnResource($record))->response()->setStatusCode(201);
    }

    public function show(PharmacyReturn $record): PharmacyReturnResource
    {
        return new PharmacyReturnResource($record);
    }

    public function update(UpdatePharmacyReturnRequest $request, PharmacyReturn $record): PharmacyReturnResource
    {
        $record->update($request->validated());

        return new PharmacyReturnResource($record);
    }

    public function destroy(PharmacyReturn $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
