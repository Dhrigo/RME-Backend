<?php

namespace Modules\PembayaranInvoiceSubsidy\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranInvoiceSubsidy\Http\Requests\StoreInvoiceSubsidyRequest;
use Modules\PembayaranInvoiceSubsidy\Http\Requests\UpdateInvoiceSubsidyRequest;
use Modules\PembayaranInvoiceSubsidy\Http\Resources\InvoiceSubsidyResource;
use Modules\PembayaranInvoiceSubsidy\Models\InvoiceSubsidy;

class InvoiceSubsidyController extends Controller
{
    public function index(Request $request)
    {
        $query = InvoiceSubsidy::query();

        if ($request->filled('invoice_id')) {
            $query->where('invoice_id', $request->integer('invoice_id'));
        }

        return InvoiceSubsidyResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreInvoiceSubsidyRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'pending';

        $subsidy = InvoiceSubsidy::create($data);

        return (new InvoiceSubsidyResource($subsidy))->response()->setStatusCode(201);
    }

    public function show(InvoiceSubsidy $invoice_subsidy): InvoiceSubsidyResource
    {
        return new InvoiceSubsidyResource($invoice_subsidy);
    }

    public function update(UpdateInvoiceSubsidyRequest $request, InvoiceSubsidy $invoice_subsidy): InvoiceSubsidyResource
    {
        $data = $request->validated();

        if (($data['status'] ?? null) === 'approved' && $invoice_subsidy->status !== 'approved') {
            $data['approved_by'] = $request->user()->id;
            $data['approved_at'] = now();
        }

        $invoice_subsidy->update($data);

        return new InvoiceSubsidyResource($invoice_subsidy);
    }

    public function destroy(InvoiceSubsidy $invoice_subsidy)
    {
        $invoice_subsidy->delete();

        return response()->json(null, 204);
    }
}
