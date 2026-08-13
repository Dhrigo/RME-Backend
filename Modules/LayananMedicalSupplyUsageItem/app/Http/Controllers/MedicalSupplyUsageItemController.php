<?php

namespace Modules\LayananMedicalSupplyUsageItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananMedicalSupplyUsageItem\Http\Requests\StoreMedicalSupplyUsageItemRequest;
use Modules\LayananMedicalSupplyUsageItem\Http\Resources\MedicalSupplyUsageItemResource;
use Modules\LayananMedicalSupplyUsageItem\Models\MedicalSupplyUsageItem;

class MedicalSupplyUsageItemController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicalSupplyUsageItem::query();

        return MedicalSupplyUsageItemResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMedicalSupplyUsageItemRequest $request)
    {
        $data = $request->validated();

        $supply_usage_item = MedicalSupplyUsageItem::create($data);

        return (new MedicalSupplyUsageItemResource($supply_usage_item))->response()->setStatusCode(201);
    }

    public function show(MedicalSupplyUsageItem $supply_usage_item): MedicalSupplyUsageItemResource
    {
        return new MedicalSupplyUsageItemResource($supply_usage_item);
    }
}
