<?php

namespace Modules\GeneralGuarantorItemCategoryMapping\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralGuarantorItemCategoryMapping\Http\Requests\StoreGuarantorItemCategoryMappingRequest;
use Modules\GeneralGuarantorItemCategoryMapping\Http\Requests\UpdateGuarantorItemCategoryMappingRequest;
use Modules\GeneralGuarantorItemCategoryMapping\Http\Resources\GuarantorItemCategoryMappingResource;
use Modules\GeneralGuarantorItemCategoryMapping\Models\GuarantorItemCategoryMapping;

class GuarantorItemCategoryMappingController extends Controller
{
    public function index(Request $request)
    {
        $query = GuarantorItemCategoryMapping::query();

        if ($request->filled('guarantor_id')) {
            $query->where('guarantor_id', $request->integer('guarantor_id'));
        }

        return GuarantorItemCategoryMappingResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreGuarantorItemCategoryMappingRequest $request)
    {
        $mapping = GuarantorItemCategoryMapping::create($request->validated());

        return (new GuarantorItemCategoryMappingResource($mapping))->response()->setStatusCode(201);
    }

    public function show(GuarantorItemCategoryMapping $guarantor_item_category_mapping): GuarantorItemCategoryMappingResource
    {
        return new GuarantorItemCategoryMappingResource($guarantor_item_category_mapping);
    }

    public function update(UpdateGuarantorItemCategoryMappingRequest $request, GuarantorItemCategoryMapping $guarantor_item_category_mapping): GuarantorItemCategoryMappingResource
    {
        $guarantor_item_category_mapping->update($request->validated());

        return new GuarantorItemCategoryMappingResource($guarantor_item_category_mapping);
    }

    public function destroy(GuarantorItemCategoryMapping $guarantor_item_category_mapping)
    {
        $guarantor_item_category_mapping->delete();

        return response()->json(null, 204);
    }
}
