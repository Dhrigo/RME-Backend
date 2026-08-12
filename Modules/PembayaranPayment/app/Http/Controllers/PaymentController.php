<?php

namespace Modules\PembayaranPayment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPayment\Http\Requests\StorePaymentRequest;
use Modules\PembayaranPayment\Http\Resources\PaymentResource;
use Modules\PembayaranPayment\Models\Payment;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::query();

        if ($request->filled('invoice_id')) {
            $query->where('invoice_id', $request->integer('invoice_id'));
        }

        return PaymentResource::collection($query->latest('paid_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Payments are financial records, not freely editable/deletable once made -
     * only index/store/show. Corrections belong in a reversal entry, not in scope yet.
     */
    public function store(StorePaymentRequest $request)
    {
        $invoice = Invoice::findOrFail($request->integer('invoice_id'));
        abort_if($invoice->is_locked, 422, 'Tagihan ini sudah lunas dan dikunci.');

        $data = $request->validated();
        $data['payment_number'] ??= Payment::generatePaymentNumber();
        $data['paid_at'] ??= now();
        $data['received_by'] = $request->user()->id;

        $payment = Payment::create($data);

        $totalPaid = $invoice->payments()->sum('amount');
        if ($totalPaid >= $invoice->total_amount) {
            $invoice->update(['is_locked' => true, 'status' => 'paid']);
        }

        return (new PaymentResource($payment))->response()->setStatusCode(201);
    }

    public function show(Payment $payment): PaymentResource
    {
        return new PaymentResource($payment);
    }
}
