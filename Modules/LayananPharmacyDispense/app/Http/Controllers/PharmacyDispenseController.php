<?php

namespace Modules\LayananPharmacyDispense\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPharmacyDispense\Http\Requests\StorePharmacyDispenseRequest;
use Modules\LayananPharmacyDispense\Http\Requests\UpdatePharmacyDispenseRequest;
use Modules\LayananPharmacyDispense\Http\Resources\PharmacyDispenseResource;
use Modules\LayananPharmacyDispense\Models\PharmacyDispense;

class PharmacyDispenseController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyDispense::query();

        return PharmacyDispenseResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyDispenseRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $data['status'] ?? 'pending';
        $dispense = PharmacyDispense::create($data);

        return (new PharmacyDispenseResource($dispense))->response()->setStatusCode(201);
    }

    public function show(PharmacyDispense $dispense): PharmacyDispenseResource
    {
        return new PharmacyDispenseResource($dispense);
    }

    public function update(UpdatePharmacyDispenseRequest $request, PharmacyDispense $dispense): PharmacyDispenseResource
    {
        $dispense->update($request->validated());

        return new PharmacyDispenseResource($dispense);
    }
}
