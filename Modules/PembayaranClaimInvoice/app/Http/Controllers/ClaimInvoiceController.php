<?php

namespace Modules\PembayaranClaimInvoice\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranClaimInvoice\Http\Requests\StoreClaimInvoiceRequest;
use Modules\PembayaranClaimInvoice\Http\Requests\UpdateClaimInvoiceRequest;
use Modules\PembayaranClaimInvoice\Http\Resources\ClaimInvoiceResource;
use Modules\PembayaranClaimInvoice\Models\ClaimInvoice;

class ClaimInvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = ClaimInvoice::query();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        return ClaimInvoiceResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreClaimInvoiceRequest $request)
    {
        $data = $request->validated();
        $data['claim_number'] ??= ClaimInvoice::generateClaimNumber();
        $data['status'] ??= 'draft';

        $claimInvoice = ClaimInvoice::create($data);

        return (new ClaimInvoiceResource($claimInvoice))->response()->setStatusCode(201);
    }

    public function show(ClaimInvoice $claim_invoice): ClaimInvoiceResource
    {
        return new ClaimInvoiceResource($claim_invoice);
    }

    public function update(UpdateClaimInvoiceRequest $request, ClaimInvoice $claim_invoice): ClaimInvoiceResource
    {
        $data = $request->validated();

        if (($data['status'] ?? null) === 'submitted' && $claim_invoice->status !== 'submitted') {
            $data['submitted_at'] = now();
        }

        $claim_invoice->update($data);

        return new ClaimInvoiceResource($claim_invoice);
    }

    public function destroy(ClaimInvoice $claim_invoice)
    {
        $claim_invoice->delete();

        return response()->json(null, 204);
    }
}
