<?php

namespace Modules\PembayaranInvoice\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranInvoice\Http\Requests\StoreInvoiceRequest;
use Modules\PembayaranInvoice\Http\Requests\UpdateInvoiceRequest;
use Modules\PembayaranInvoice\Http\Resources\InvoiceResource;
use Modules\PembayaranInvoice\Models\Invoice;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return InvoiceResource::collection($query->latest('invoice_date')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreInvoiceRequest $request)
    {
        $data = $request->validated();
        $data['invoice_number'] ??= Invoice::generateInvoiceNumber();
        $data['invoice_date'] ??= now();
        $data['created_by'] = $request->user()->id;

        $invoice = Invoice::create($data);

        return (new InvoiceResource($invoice))->response()->setStatusCode(201);
    }

    public function show(Invoice $invoice): InvoiceResource
    {
        return new InvoiceResource($invoice->load('items', 'payments'));
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice): InvoiceResource
    {
        abort_if($invoice->is_locked, 422, 'Tagihan ini sudah dikunci, tidak bisa diubah.');

        $invoice->update($request->validated());

        return new InvoiceResource($invoice);
    }

    public function destroy(Invoice $invoice)
    {
        abort_if($invoice->is_locked, 422, 'Tagihan ini sudah dikunci, tidak bisa dihapus.');

        $invoice->delete();

        return response()->json(null, 204);
    }
}
