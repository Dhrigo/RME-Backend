<?php

namespace Modules\PenjualanSaleItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PenjualanSaleItem\Http\Requests\StoreSaleItemRequest;
use Modules\PenjualanSaleItem\Http\Resources\SaleItemResource;
use Modules\PenjualanSaleItem\Models\SaleItem;

class SaleItemController extends Controller
{
    public function index(Request $request)
    {
        $query = SaleItem::query();

        if ($request->filled('sale_id')) {
            $query->where('sale_id', $request->integer('sale_id'));
        }

        return SaleItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    /**
     * Sale line items are append-only - a sale is corrected via a return, not by
     * editing/deleting a sold line.
     */
    public function store(StoreSaleItemRequest $request)
    {
        $item = SaleItem::create($request->validated());

        return (new SaleItemResource($item))->response()->setStatusCode(201);
    }

    public function show(SaleItem $saleItem): SaleItemResource
    {
        return new SaleItemResource($saleItem);
    }
}
