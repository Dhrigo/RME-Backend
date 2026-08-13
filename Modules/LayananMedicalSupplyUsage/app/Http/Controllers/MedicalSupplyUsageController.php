<?php

namespace Modules\LayananMedicalSupplyUsage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananMedicalSupplyUsage\Http\Requests\StoreMedicalSupplyUsageRequest;
use Modules\LayananMedicalSupplyUsage\Http\Requests\UpdateMedicalSupplyUsageRequest;
use Modules\LayananMedicalSupplyUsage\Http\Resources\MedicalSupplyUsageResource;
use Modules\LayananMedicalSupplyUsage\Models\MedicalSupplyUsage;

class MedicalSupplyUsageController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicalSupplyUsage::query();

        return MedicalSupplyUsageResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMedicalSupplyUsageRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $data['status'] ?? 'draft';
        $supply_usage = MedicalSupplyUsage::create($data);

        return (new MedicalSupplyUsageResource($supply_usage))->response()->setStatusCode(201);
    }

    public function show(MedicalSupplyUsage $supply_usage): MedicalSupplyUsageResource
    {
        return new MedicalSupplyUsageResource($supply_usage);
    }

    public function update(UpdateMedicalSupplyUsageRequest $request, MedicalSupplyUsage $supply_usage): MedicalSupplyUsageResource
    {
        $supply_usage->update($request->validated());

        return new MedicalSupplyUsageResource($supply_usage);
    }
}
