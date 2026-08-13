<?php

namespace Modules\PembayaranInvoiceMerge\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranInvoiceMerge\Http\Requests\StoreInvoiceMergeRequest;
use Modules\PembayaranInvoiceMerge\Http\Requests\UpdateInvoiceMergeRequest;
use Modules\PembayaranInvoiceMerge\Http\Resources\InvoiceMergeResource;
use Modules\PembayaranInvoiceMerge\Models\InvoiceMerge;

class InvoiceMergeController extends Controller
{
    public function index(Request $request)
    {
        $query = InvoiceMerge::query();

        if ($request->filled('payment_id')) {
            $query->where('payment_id', $request->integer('payment_id'));
        }

        return InvoiceMergeResource::collection($query->latest('merged_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreInvoiceMergeRequest $request)
    {
        $data = $request->validated();
        $data['merge_number'] ??= InvoiceMerge::generateMergeNumber();
        $data['merged_at'] ??= now();
        $data['merged_by'] = $request->user()->id;

        $invoiceMerge = InvoiceMerge::create($data);

        return (new InvoiceMergeResource($invoiceMerge))->response()->setStatusCode(201);
    }

    public function show(InvoiceMerge $invoice_merge): InvoiceMergeResource
    {
        return new InvoiceMergeResource($invoice_merge);
    }

    public function update(UpdateInvoiceMergeRequest $request, InvoiceMerge $invoice_merge): InvoiceMergeResource
    {
        $invoice_merge->update($request->validated());

        return new InvoiceMergeResource($invoice_merge);
    }

    public function destroy(InvoiceMerge $invoice_merge)
    {
        $invoice_merge->delete();

        return response()->json(null, 204);
    }
}
