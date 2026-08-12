<?php

namespace Modules\PembayaranInvoiceItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceItem\Http\Requests\StoreInvoiceItemRequest;
use Modules\PembayaranInvoiceItem\Http\Requests\UpdateInvoiceItemRequest;
use Modules\PembayaranInvoiceItem\Http\Resources\InvoiceItemResource;
use Modules\PembayaranInvoiceItem\Models\InvoiceItem;

class InvoiceItemController extends Controller
{
    public function index(Request $request)
    {
        $query = InvoiceItem::query();

        if ($request->filled('invoice_id')) {
            $query->where('invoice_id', $request->integer('invoice_id'));
        }

        return InvoiceItemResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreInvoiceItemRequest $request)
    {
        $invoice = Invoice::findOrFail($request->integer('invoice_id'));
        abort_if($invoice->is_locked, 422, 'Tagihan ini sudah dikunci, tidak bisa ditambah item.');

        $item = InvoiceItem::create($request->validated());
        $invoice->recalculateTotals();

        return (new InvoiceItemResource($item))->response()->setStatusCode(201);
    }

    public function show(InvoiceItem $invoice_item): InvoiceItemResource
    {
        return new InvoiceItemResource($invoice_item);
    }

    public function update(UpdateInvoiceItemRequest $request, InvoiceItem $invoice_item): InvoiceItemResource
    {
        abort_if($invoice_item->invoice->is_locked, 422, 'Tagihan ini sudah dikunci, tidak bisa diubah.');

        $invoice_item->update($request->validated());
        $invoice_item->invoice->recalculateTotals();

        return new InvoiceItemResource($invoice_item);
    }

    public function destroy(InvoiceItem $invoice_item)
    {
        abort_if($invoice_item->invoice->is_locked, 422, 'Tagihan ini sudah dikunci, tidak bisa dihapus.');

        $invoice = $invoice_item->invoice;
        $invoice_item->delete();
        $invoice->recalculateTotals();

        return response()->json(null, 204);
    }
}
