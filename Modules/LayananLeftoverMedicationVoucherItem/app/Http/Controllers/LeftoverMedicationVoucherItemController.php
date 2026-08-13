<?php

namespace Modules\LayananLeftoverMedicationVoucherItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLeftoverMedicationVoucherItem\Http\Requests\StoreLeftoverMedicationVoucherItemRequest;
use Modules\LayananLeftoverMedicationVoucherItem\Http\Resources\LeftoverMedicationVoucherItemResource;
use Modules\LayananLeftoverMedicationVoucherItem\Models\LeftoverMedicationVoucherItem;

class LeftoverMedicationVoucherItemController extends Controller
{
    public function index(Request $request)
    {
        $query = LeftoverMedicationVoucherItem::query();

        return LeftoverMedicationVoucherItemResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLeftoverMedicationVoucherItemRequest $request)
    {
        $data = $request->validated();

        $voucher_item = LeftoverMedicationVoucherItem::create($data);

        return (new LeftoverMedicationVoucherItemResource($voucher_item))->response()->setStatusCode(201);
    }

    public function show(LeftoverMedicationVoucherItem $voucher_item): LeftoverMedicationVoucherItemResource
    {
        return new LeftoverMedicationVoucherItemResource($voucher_item);
    }
}
