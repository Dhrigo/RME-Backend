<?php

namespace Modules\LayananLeftoverMedicationVoucher\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLeftoverMedicationVoucher\Http\Requests\StoreLeftoverMedicationVoucherRequest;
use Modules\LayananLeftoverMedicationVoucher\Http\Requests\UpdateLeftoverMedicationVoucherRequest;
use Modules\LayananLeftoverMedicationVoucher\Http\Resources\LeftoverMedicationVoucherResource;
use Modules\LayananLeftoverMedicationVoucher\Models\LeftoverMedicationVoucher;

class LeftoverMedicationVoucherController extends Controller
{
    public function index(Request $request)
    {
        $query = LeftoverMedicationVoucher::query();

        return LeftoverMedicationVoucherResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLeftoverMedicationVoucherRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $data['status'] ?? 'pending';
        $voucher = LeftoverMedicationVoucher::create($data);

        return (new LeftoverMedicationVoucherResource($voucher))->response()->setStatusCode(201);
    }

    public function show(LeftoverMedicationVoucher $voucher): LeftoverMedicationVoucherResource
    {
        return new LeftoverMedicationVoucherResource($voucher);
    }

    public function update(UpdateLeftoverMedicationVoucherRequest $request, LeftoverMedicationVoucher $voucher): LeftoverMedicationVoucherResource
    {
        $voucher->update($request->validated());

        return new LeftoverMedicationVoucherResource($voucher);
    }
}
