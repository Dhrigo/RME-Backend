<?php

namespace Modules\PembayaranPackageInvoiceItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranPackageInvoiceItem\Http\Requests\StorePackageInvoiceItemRequest;
use Modules\PembayaranPackageInvoiceItem\Http\Requests\UpdatePackageInvoiceItemRequest;
use Modules\PembayaranPackageInvoiceItem\Http\Resources\PackageInvoiceItemResource;
use Modules\PembayaranPackageInvoiceItem\Models\PackageInvoiceItem;

class PackageInvoiceItemController extends Controller
{
    public function index(Request $request)
    {
        $query = PackageInvoiceItem::query();

        if ($request->filled('invoice_id')) {
            $query->where('invoice_id', $request->integer('invoice_id'));
        }

        return PackageInvoiceItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePackageInvoiceItemRequest $request)
    {
        $data = $request->validated();
        $data['quantity'] ??= 1;

        $item = PackageInvoiceItem::create($data);

        return (new PackageInvoiceItemResource($item))->response()->setStatusCode(201);
    }

    public function show(PackageInvoiceItem $package_invoice_item): PackageInvoiceItemResource
    {
        return new PackageInvoiceItemResource($package_invoice_item);
    }

    public function update(UpdatePackageInvoiceItemRequest $request, PackageInvoiceItem $package_invoice_item): PackageInvoiceItemResource
    {
        $package_invoice_item->update($request->validated());

        return new PackageInvoiceItemResource($package_invoice_item);
    }

    public function destroy(PackageInvoiceItem $package_invoice_item)
    {
        $package_invoice_item->delete();

        return response()->json(null, 204);
    }
}
