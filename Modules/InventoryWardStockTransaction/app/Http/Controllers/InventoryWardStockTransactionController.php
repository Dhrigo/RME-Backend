<?php

namespace Modules\InventoryWardStockTransaction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\InventoryWardItemStock\Models\WardItemStock;
use Modules\InventoryWardStockTransaction\Http\Requests\StoreWardStockTransactionRequest;
use Modules\InventoryWardStockTransaction\Http\Resources\WardStockTransactionResource;
use Modules\InventoryWardStockTransaction\Models\WardStockTransaction;

class InventoryWardStockTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = WardStockTransaction::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        if ($request->filled('item_id')) {
            $query->where('item_id', $request->integer('item_id'));
        }

        return WardStockTransactionResource::collection($query->latest('performed_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * A transaction is append-only, same as PendaftaranHistory - it is the ledger entry.
     * The running balance lives in InventoryWardItemStock and is adjusted here.
     */
    public function store(StoreWardStockTransactionRequest $request)
    {
        $data = $request->validated();
        $data['performed_at'] ??= now();
        $data['performed_by'] = $request->user()->id;

        $stock = WardItemStock::firstOrCreate(
            ['ward_id' => $data['ward_id'], 'item_id' => $data['item_id']],
            ['quantity' => 0]
        );

        if ($data['type'] === 'out' && $stock->quantity < $data['quantity']) {
            throw ValidationException::withMessages(['quantity' => 'Stok ruangan tidak cukup untuk transaksi keluar.']);
        }

        $transaction = WardStockTransaction::create($data);

        $stock->increment('quantity', $data['type'] === 'in' ? $data['quantity'] : -$data['quantity']);

        return (new WardStockTransactionResource($transaction))->response()->setStatusCode(201);
    }

    public function show(WardStockTransaction $ward_stock_transaction): WardStockTransactionResource
    {
        return new WardStockTransactionResource($ward_stock_transaction);
    }
}
