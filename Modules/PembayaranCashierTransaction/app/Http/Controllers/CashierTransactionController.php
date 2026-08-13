<?php

namespace Modules\PembayaranCashierTransaction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranCashierTransaction\Http\Requests\StoreCashierTransactionRequest;
use Modules\PembayaranCashierTransaction\Http\Resources\CashierTransactionResource;
use Modules\PembayaranCashierTransaction\Models\CashierTransaction;

class CashierTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = CashierTransaction::query();

        if ($request->filled('cashier_id')) {
            $query->where('cashier_id', $request->integer('cashier_id'));
        }

        return CashierTransactionResource::collection($query->latest('transacted_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Cashier transactions are a financial ledger entry - append-only, no update/delete.
     */
    public function store(StoreCashierTransactionRequest $request)
    {
        $data = $request->validated();
        $data['transacted_at'] ??= now();

        $transaction = CashierTransaction::create($data);

        return (new CashierTransactionResource($transaction))->response()->setStatusCode(201);
    }

    public function show(CashierTransaction $cashier_transaction): CashierTransactionResource
    {
        return new CashierTransactionResource($cashier_transaction);
    }
}
