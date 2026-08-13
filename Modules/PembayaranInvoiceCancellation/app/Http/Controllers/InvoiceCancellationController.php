<?php

namespace Modules\PembayaranInvoiceCancellation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceCancellation\Http\Requests\StoreInvoiceCancellationRequest;
use Modules\PembayaranInvoiceCancellation\Http\Resources\InvoiceCancellationResource;
use Modules\PembayaranInvoiceCancellation\Models\InvoiceCancellation;

class InvoiceCancellationController extends Controller
{
    public function index(Request $request)
    {
        $query = InvoiceCancellation::query();

        if ($request->filled('invoice_id')) {
            $query->where('invoice_id', $request->integer('invoice_id'));
        }

        return InvoiceCancellationResource::collection($query->latest('cancelled_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Cancellation is a legal/financial record - append-only, no update/delete.
     * Locks the invoice and marks it cancelled.
     */
    public function store(StoreInvoiceCancellationRequest $request)
    {
        $data = $request->validated();
        $data['cancelled_at'] = now();
        $data['cancelled_by'] = $request->user()->id;

        $cancellation = DB::transaction(function () use ($data) {
            $cancellation = InvoiceCancellation::create($data);
            Invoice::whereKey($data['invoice_id'])->update(['status' => 'cancelled', 'is_locked' => true]);

            return $cancellation;
        });

        return (new InvoiceCancellationResource($cancellation))->response()->setStatusCode(201);
    }

    public function show(InvoiceCancellation $invoice_cancellation): InvoiceCancellationResource
    {
        return new InvoiceCancellationResource($invoice_cancellation);
    }
}
