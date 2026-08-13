<?php

namespace Modules\LayananPharmacyServiceTimeStage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPharmacyServiceTimeStage\Http\Requests\StorePharmacyServiceTimeStageRequest;
use Modules\LayananPharmacyServiceTimeStage\Http\Resources\PharmacyServiceTimeStageResource;
use Modules\LayananPharmacyServiceTimeStage\Models\PharmacyServiceTimeStage;

class PharmacyServiceTimeStageController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyServiceTimeStage::query();

        return PharmacyServiceTimeStageResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyServiceTimeStageRequest $request)
    {
        $data = $request->validated();

        $record = PharmacyServiceTimeStage::create($data);

        return (new PharmacyServiceTimeStageResource($record))->response()->setStatusCode(201);
    }

    public function show(PharmacyServiceTimeStage $record): PharmacyServiceTimeStageResource
    {
        return new PharmacyServiceTimeStageResource($record);
    }

    public function destroy(PharmacyServiceTimeStage $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
