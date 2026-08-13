<?php

namespace Modules\PembayaranDepositRefund\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\PembayaranDeposit\Models\Deposit;
use Modules\PembayaranDepositRefund\Http\Requests\StoreDepositRefundRequest;
use Modules\PembayaranDepositRefund\Http\Resources\DepositRefundResource;
use Modules\PembayaranDepositRefund\Models\DepositRefund;

class DepositRefundController extends Controller
{
    public function index(Request $request)
    {
        $query = DepositRefund::query();

        if ($request->filled('deposit_id')) {
            $query->where('deposit_id', $request->integer('deposit_id'));
        }

        return DepositRefundResource::collection($query->latest('refunded_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Refund is a financial record - append-only, no update/delete.
     * Marks the parent deposit as refunded.
     */
    public function store(StoreDepositRefundRequest $request)
    {
        $data = $request->validated();
        $data['refunded_at'] = now();
        $data['refunded_by'] = $request->user()->id;

        $refund = DB::transaction(function () use ($data) {
            $refund = DepositRefund::create($data);
            Deposit::whereKey($data['deposit_id'])->update(['status' => 'refunded']);

            return $refund;
        });

        return (new DepositRefundResource($refund))->response()->setStatusCode(201);
    }

    public function show(DepositRefund $deposit_refund): DepositRefundResource
    {
        return new DepositRefundResource($deposit_refund);
    }
}
