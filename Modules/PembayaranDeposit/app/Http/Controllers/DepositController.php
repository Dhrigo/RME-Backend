<?php

namespace Modules\PembayaranDeposit\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranDeposit\Http\Requests\StoreDepositRequest;
use Modules\PembayaranDeposit\Http\Requests\UpdateDepositRequest;
use Modules\PembayaranDeposit\Http\Resources\DepositResource;
use Modules\PembayaranDeposit\Models\Deposit;

class DepositController extends Controller
{
    public function index(Request $request)
    {
        $query = Deposit::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return DepositResource::collection($query->latest('paid_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Deposits are financial records - amount/visit are append-only. Only the
     * status transitions (held -> applied/refunded).
     */
    public function store(StoreDepositRequest $request)
    {
        $data = $request->validated();
        $data['deposit_number'] = Deposit::generateDepositNumber();
        $data['paid_at'] ??= now();
        $data['received_by'] = $request->user()->id;
        $data['status'] = 'held';

        $deposit = Deposit::create($data);

        return (new DepositResource($deposit))->response()->setStatusCode(201);
    }

    public function show(Deposit $deposit): DepositResource
    {
        return new DepositResource($deposit);
    }

    public function update(UpdateDepositRequest $request, Deposit $deposit): DepositResource
    {
        abort_if($deposit->status !== 'held', 422, 'Deposit ini sudah diproses.');

        $deposit->update($request->validated());

        return new DepositResource($deposit);
    }
}
