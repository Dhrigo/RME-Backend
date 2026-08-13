<?php

namespace Modules\LayananMedicationServiceLimit\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananMedicationServiceLimit\Http\Requests\StoreMedicationServiceLimitRequest;
use Modules\LayananMedicationServiceLimit\Http\Requests\UpdateMedicationServiceLimitRequest;
use Modules\LayananMedicationServiceLimit\Http\Resources\MedicationServiceLimitResource;
use Modules\LayananMedicationServiceLimit\Models\MedicationServiceLimit;

class MedicationServiceLimitController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicationServiceLimit::query();

        return MedicationServiceLimitResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMedicationServiceLimitRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $data['is_active'] ?? true;
        $service_limit = MedicationServiceLimit::create($data);

        return (new MedicationServiceLimitResource($service_limit))->response()->setStatusCode(201);
    }

    public function show(MedicationServiceLimit $service_limit): MedicationServiceLimitResource
    {
        return new MedicationServiceLimitResource($service_limit);
    }

    public function update(UpdateMedicationServiceLimitRequest $request, MedicationServiceLimit $service_limit): MedicationServiceLimitResource
    {
        $service_limit->update($request->validated());

        return new MedicationServiceLimitResource($service_limit);
    }

    public function destroy(MedicationServiceLimit $service_limit)
    {
        $service_limit->delete();

        return response()->json(null, 204);
    }
}
