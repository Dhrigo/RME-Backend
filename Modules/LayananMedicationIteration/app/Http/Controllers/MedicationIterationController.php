<?php

namespace Modules\LayananMedicationIteration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananMedicationIteration\Http\Requests\StoreMedicationIterationRequest;
use Modules\LayananMedicationIteration\Http\Requests\UpdateMedicationIterationRequest;
use Modules\LayananMedicationIteration\Http\Resources\MedicationIterationResource;
use Modules\LayananMedicationIteration\Models\MedicationIteration;

class MedicationIterationController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicationIteration::query();

        return MedicationIterationResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMedicationIterationRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $data['status'] ?? 'pending';
        $iteration = MedicationIteration::create($data);

        return (new MedicationIterationResource($iteration))->response()->setStatusCode(201);
    }

    public function show(MedicationIteration $iteration): MedicationIterationResource
    {
        return new MedicationIterationResource($iteration);
    }

    public function update(UpdateMedicationIterationRequest $request, MedicationIteration $iteration): MedicationIterationResource
    {
        $iteration->update($request->validated());

        return new MedicationIterationResource($iteration);
    }
}
