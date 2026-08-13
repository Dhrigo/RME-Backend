<?php

namespace Modules\PembayaranRegistrationInvoice\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranRegistrationInvoice\Http\Requests\StoreRegistrationInvoiceRequest;
use Modules\PembayaranRegistrationInvoice\Http\Requests\UpdateRegistrationInvoiceRequest;
use Modules\PembayaranRegistrationInvoice\Http\Resources\RegistrationInvoiceResource;
use Modules\PembayaranRegistrationInvoice\Models\RegistrationInvoice;

class RegistrationInvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = RegistrationInvoice::query();

        if ($request->filled('registration_id')) {
            $query->where('registration_id', $request->integer('registration_id'));
        }

        return RegistrationInvoiceResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRegistrationInvoiceRequest $request)
    {
        $data = $request->validated();
        $data['invoice_category'] ??= 'registration_fee';

        $registrationInvoice = RegistrationInvoice::create($data);

        return (new RegistrationInvoiceResource($registrationInvoice))->response()->setStatusCode(201);
    }

    public function show(RegistrationInvoice $registration_invoice): RegistrationInvoiceResource
    {
        return new RegistrationInvoiceResource($registration_invoice);
    }

    public function update(UpdateRegistrationInvoiceRequest $request, RegistrationInvoice $registration_invoice): RegistrationInvoiceResource
    {
        $registration_invoice->update($request->validated());

        return new RegistrationInvoiceResource($registration_invoice);
    }

    public function destroy(RegistrationInvoice $registration_invoice)
    {
        $registration_invoice->delete();

        return response()->json(null, 204);
    }
}
