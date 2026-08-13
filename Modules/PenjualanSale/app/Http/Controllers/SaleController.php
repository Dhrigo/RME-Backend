<?php

namespace Modules\PenjualanSale\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PenjualanSale\Http\Requests\StoreSaleRequest;
use Modules\PenjualanSale\Http\Requests\UpdateSaleRequest;
use Modules\PenjualanSale\Http\Resources\SaleResource;
use Modules\PenjualanSale\Models\Sale;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return SaleResource::collection($query->latest('sold_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreSaleRequest $request)
    {
        $data = $request->validated();
        $data['sale_number'] = Sale::generateSaleNumber();
        $data['sold_at'] ??= now();

        $sale = Sale::create($data);

        return (new SaleResource($sale))->response()->setStatusCode(201);
    }

    public function show(Sale $sale): SaleResource
    {
        return new SaleResource($sale);
    }

    public function update(UpdateSaleRequest $request, Sale $sale): SaleResource
    {
        $sale->update($request->validated());

        return new SaleResource($sale);
    }
}
