<?php

namespace Modules\PembayaranInvoiceGuarantor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranInvoiceGuarantor\Http\Requests\StoreInvoiceGuarantorRequest;
use Modules\PembayaranInvoiceGuarantor\Http\Requests\UpdateInvoiceGuarantorRequest;
use Modules\PembayaranInvoiceGuarantor\Http\Resources\InvoiceGuarantorResource;
use Modules\PembayaranInvoiceGuarantor\Models\InvoiceGuarantor;

class InvoiceGuarantorController extends Controller
{
    public function index(Request $request)
    {
        $query = InvoiceGuarantor::query();

        if ($request->filled('invoice_id')) {
            $query->where('invoice_id', $request->integer('invoice_id'));
        }

        return InvoiceGuarantorResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreInvoiceGuarantorRequest $request)
    {
        $data = $request->validated();
        $data['covered_amount'] ??= 0;
        $data['verification_status'] ??= 'pending';

        $invoiceGuarantor = InvoiceGuarantor::create($data);

        return (new InvoiceGuarantorResource($invoiceGuarantor))->response()->setStatusCode(201);
    }

    public function show(InvoiceGuarantor $invoice_guarantor): InvoiceGuarantorResource
    {
        return new InvoiceGuarantorResource($invoice_guarantor);
    }

    public function update(UpdateInvoiceGuarantorRequest $request, InvoiceGuarantor $invoice_guarantor): InvoiceGuarantorResource
    {
        $data = $request->validated();

        if (($data['verification_status'] ?? null) === 'verified' && $invoice_guarantor->verification_status !== 'verified') {
            $data['verified_by'] = $request->user()->id;
            $data['verified_at'] = now();
        }

        $invoice_guarantor->update($data);

        return new InvoiceGuarantorResource($invoice_guarantor);
    }

    public function destroy(InvoiceGuarantor $invoice_guarantor)
    {
        $invoice_guarantor->delete();

        return response()->json(null, 204);
    }
}
