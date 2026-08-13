<?php

namespace Modules\MedicalRecordFluidFinalBalance\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordFluidFinalBalance\Http\Requests\StoreFluidFinalBalanceRequest;
use Modules\MedicalRecordFluidFinalBalance\Http\Requests\UpdateFluidFinalBalanceRequest;
use Modules\MedicalRecordFluidFinalBalance\Http\Resources\FluidFinalBalanceResource;
use Modules\MedicalRecordFluidFinalBalance\Models\FluidFinalBalance;

class FluidFinalBalanceController extends Controller
{
    public function index(Request $request)
    {
        $query = FluidFinalBalance::query();

        return FluidFinalBalanceResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreFluidFinalBalanceRequest $request)
    {
        $data = $request->validated();

        $record = FluidFinalBalance::create($data);

        return (new FluidFinalBalanceResource($record))->response()->setStatusCode(201);
    }

    public function show(FluidFinalBalance $record): FluidFinalBalanceResource
    {
        return new FluidFinalBalanceResource($record);
    }

    public function update(UpdateFluidFinalBalanceRequest $request, FluidFinalBalance $record): FluidFinalBalanceResource
    {
        $record->update($request->validated());

        return new FluidFinalBalanceResource($record);
    }

    public function destroy(FluidFinalBalance $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
